<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    private $adminEmails = [
        'yousha.cse.20230104097@aust.edu',
        'aaheed.cse.20230104092@aust.edu',
        'miraz.cse.20230104092@aust.edu',
        'noman.cse.20230104088@aust.edu',
    ];

    /**
     * Check if the logged-in user is an admin.
     */
    private function authorizeAdmin()
    {
        if (!Auth::check() || !in_array(Auth::user()->email, $this->adminEmails)) {
            abort(403, 'Unauthorized access.');
        }
    }

    public function index()
    {
        $this->authorizeAdmin();
        return view('admin.dashboard');
    }

    public function foods()
    {
        $this->authorizeAdmin();

        // Raw query to fetch all food items - NEWEST FIRST
        $foods = DB::select('SELECT * FROM food_items ORDER BY id DESC');

        return view('admin.foods', compact('foods'));
    }

    public function addFood(Request $request)
    {
        $this->authorizeAdmin();

        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|string', 
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageUrl = $request->image;

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('foods', 'public');
            $imageUrl = 'storage/' . $path;
        }

        // Raw query using named bindings
        DB::insert('INSERT INTO food_items (name, category, price, description, image, is_available, created_at, updated_at) 
                    VALUES (:name, :category, :price, :description, :image, :is_available, :created_at, :updated_at)', [
            'name' => $request->name,
            'category' => $request->category,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $imageUrl,
            'is_available' => $request->has('is_available') ? 1 : 0,
            'created_at' => now()->toDateTimeString(),
            'updated_at' => now()->toDateTimeString()
        ]);

        return redirect()->back()->with('success', 'Food item added successfully!');
    }

    public function updateFood(Request $request, $id)
    {
        $this->authorizeAdmin();

        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $current = DB::selectOne('SELECT image FROM food_items WHERE id = ?', [$id]);
        if (!$current) {
            return redirect()->back()->with('error', 'Item not found.');
        }

        $imageUrl = $current->image;

        if ($request->filled('image')) {
            $imageUrl = $request->image;
        }

        if ($request->hasFile('image_file')) {
            if ($current->image && strpos($current->image, 'storage/') === 0) {
                $oldPath = str_replace('storage/', '', $current->image);
                Storage::disk('public')->delete($oldPath);
            }
            $path = $request->file('image_file')->store('foods', 'public');
            $imageUrl = 'storage/' . $path;
        }

        // Raw query using named bindings
        DB::update('UPDATE food_items SET name = :name, category = :category, price = :price, 
                    description = :description, image = :image, is_available = :is_available, 
                    updated_at = :updated_at WHERE id = :id', [
            'name' => $request->name,
            'category' => $request->category,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $imageUrl,
            'is_available' => $request->has('is_available') ? 1 : 0,
            'updated_at' => now()->toDateTimeString(),
            'id' => $id
        ]);

        return redirect()->back()->with('success', 'Food item updated successfully!');
    }

    public function deleteFood($id)
    {
        $this->authorizeAdmin();
        
        $current = DB::selectOne('SELECT image FROM food_items WHERE id = ?', [$id]);
        if ($current && $current->image && strpos($current->image, 'storage/') === 0) {
            $path = str_replace('storage/', '', $current->image);
            Storage::disk('public')->delete($path);
        }

        DB::delete('DELETE FROM food_items WHERE id = ?', [$id]);
        return redirect()->back()->with('success', 'Food item deleted successfully!');
    }

    public function orders()
    {
        $this->authorizeAdmin();

        // Raw query to fetch all orders with user names and voucher codes
        $orders = DB::select("
            SELECT o.*, u.name as user_name, u.email as user_email, v.code as voucher_code
            FROM orders o
            JOIN users u ON o.user_id = u.id
            LEFT JOIN vouchers v ON o.voucher_id = v.id
            ORDER BY o.created_at DESC
        ");

        // Fetch items for each order to show details
        foreach ($orders as $order) {
            $order->items = DB::select("
                SELECT oi.*, fi.name as food_name, fi.image as food_image
                FROM order_items oi
                JOIN food_items fi ON oi.food_item_id = fi.id
                WHERE oi.order_id = ?
            ", [$order->id]);
        }

        return view('admin.orders', compact('orders'));
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $this->authorizeAdmin();

        $request->validate([
            'status' => 'required|in:pending,completed,cancelled'
        ]);

        DB::update("UPDATE orders SET status = ?, updated_at = ? WHERE id = ?", [
            $request->status,
            now()->toDateTimeString(),
            $id
        ]);

        return redirect()->back()->with('success', 'Order status updated successfully!');
    }

    public function vouchers()
    {
        $this->authorizeAdmin();

        // Raw query to fetch vouchers
        $vouchers = DB::select('SELECT * FROM vouchers ORDER BY created_at DESC');

        return view('admin.vouchers', compact('vouchers'));
    }

    public function addVoucher(Request $request)
    {
        $this->authorizeAdmin();

        $request->validate([
            'code' => 'required|string|max:255|unique:vouchers,code',
            'discount' => 'required|numeric|min:0',
            'type' => 'required|in:percentage,fixed',
            'valid_until' => 'required|date|after:today',
            'max_uses' => 'required|integer|min:1',
        ]);

        // Raw query to insert voucher
        DB::insert('INSERT INTO vouchers (code, discount, type, valid_until, max_uses, uses, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?)', [
            strtoupper($request->code),
            $request->discount,
            $request->type,
            $request->valid_until,
            $request->max_uses,
            0, // Initial uses
            now()->toDateTimeString(),
            now()->toDateTimeString()
        ]);

        return redirect()->back()->with('success', 'Voucher added successfully!');
    }

    public function deleteVoucher($id)
    {
        $this->authorizeAdmin();
        DB::delete('DELETE FROM vouchers WHERE id = ?', [$id]);
        return redirect()->back()->with('success', 'Voucher deleted successfully!');
    }

    public function reviews()
    {
        $this->authorizeAdmin();

        // Raw query to fetch reviews with user and food item names
        $reviews = DB::select("
            SELECT r.*, u.name as user_name, f.name as food_name 
            FROM reviews r
            LEFT JOIN users u ON r.user_id = u.id
            LEFT JOIN food_items f ON r.food_item_id = f.id
            ORDER BY r.created_at DESC
        ");

        return view('admin.reviews', compact('reviews'));
    }

    public function deleteReview($id)
    {
        $this->authorizeAdmin();
        DB::delete('DELETE FROM reviews WHERE id = ?', [$id]);
        return redirect()->back()->with('success', 'Review deleted successfully!');
    }

    public function reports()
    {
        $this->authorizeAdmin();

        // Raw query to fetch reports
        $reports = DB::select('SELECT * FROM reports ORDER BY created_at DESC');

        return view('admin.reports', compact('reports'));
    }

    public function solveReport($id)
    {
        $this->authorizeAdmin();

        // Raw query to update report status to 'solved'
        DB::update("UPDATE reports SET status = 'solved', updated_at = ? WHERE id = ?", [now(), $id]);

        return redirect()->back()->with('success', 'Report marked as solved!');
    }

    public function faqs()
    {
        $this->authorizeAdmin();

        // Raw query to fetch FAQs
        $faqs = DB::select('SELECT * FROM faqs ORDER BY created_at DESC');

        return view('admin.faqs', compact('faqs'));
    }

    public function addFaq(Request $request)
    {
        $this->authorizeAdmin();

        $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
        ]);

        // Raw query to insert FAQ
        DB::insert('INSERT INTO faqs (question, answer, created_at, updated_at) VALUES (?, ?, ?, ?)', [
            $request->question,
            $request->answer,
            now()->toDateTimeString(),
            now()->toDateTimeString()
        ]);

        return redirect()->back()->with('success', 'FAQ added successfully!');
    }

    public function deleteFaq($id)
    {
        $this->authorizeAdmin();

        // Raw query to delete FAQ
        DB::delete('DELETE FROM faqs WHERE id = ?', [$id]);

        return redirect()->back()->with('success', 'FAQ deleted successfully!');
    }

    public function branches()
    {
        $this->authorizeAdmin();

        // Raw query to fetch branches
        $branches = DB::select('SELECT * FROM branches ORDER BY created_at DESC');

        return view('admin.branches', compact('branches'));
    }

    public function addBranch(Request $request)
    {
        $this->authorizeAdmin();

        $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'area' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'opening_time' => 'required',
            'closing_time' => 'required',
            'map_link' => 'nullable|url',
        ]);

        // Raw query to insert Branch
        DB::insert('INSERT INTO branches (name, city, area, address, phone, email, opening_time, closing_time, map_link, has_wifi, has_ac, has_parking, is_open, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
            $request->name,
            $request->city,
            $request->area,
            $request->address,
            $request->phone,
            $request->email,
            $request->opening_time,
            $request->closing_time,
            $request->map_link,
            $request->has('has_wifi') ? 1 : 0,
            $request->has('has_ac') ? 1 : 0,
            $request->has('has_parking') ? 1 : 0,
            $request->has('is_open') ? 1 : 0,
            now()->toDateTimeString(),
            now()->toDateTimeString()
        ]);

        return redirect()->back()->with('success', 'Branch added successfully!');
    }

    public function updateBranch(Request $request, $id)
    {
        $this->authorizeAdmin();

        $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'area' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'opening_time' => 'required',
            'closing_time' => 'required',
            'map_link' => 'nullable|url',
        ]);

        // Raw query to update Branch
        DB::update('UPDATE branches SET name=?, city=?, area=?, address=?, phone=?, email=?, opening_time=?, closing_time=?, map_link=?, has_wifi=?, has_ac=?, has_parking=?, is_open=?, updated_at=? WHERE id=?', [
            $request->name,
            $request->city,
            $request->area,
            $request->address,
            $request->phone,
            $request->email,
            $request->opening_time,
            $request->closing_time,
            $request->map_link,
            $request->has('has_wifi') ? 1 : 0,
            $request->has('has_ac') ? 1 : 0,
            $request->has('has_parking') ? 1 : 0,
            $request->has('is_open') ? 1 : 0,
            now()->toDateTimeString(),
            $id
        ]);

        return redirect()->back()->with('success', 'Branch updated successfully!');
    }

    public function deleteBranch($id)
    {
        $this->authorizeAdmin();

        // Raw query to delete Branch
        DB::delete('DELETE FROM branches WHERE id = ?', [$id]);

        return redirect()->back()->with('success', 'Branch deleted successfully!');
    }

    public function staffs()
    {
        $this->authorizeAdmin();

        // Use raw queries to fetch staff and applications
        $staffs = DB::select('SELECT * FROM staff ORDER BY joined_at DESC');
        $applications = DB::select("SELECT * FROM staff_applications WHERE status = 'pending' ORDER BY created_at DESC");

        return view('admin.staffs', compact('staffs', 'applications'));
    }

    public function approveStaff($id)
    {
        $this->authorizeAdmin();

        // Raw query to get application
        $application = DB::selectOne('SELECT * FROM staff_applications WHERE id = ?', [$id]);

        if ($application) {
            // Raw query to insert into staff
            DB::insert('INSERT INTO staff (full_name, email, phone, position, joined_at, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?)', [
                $application->full_name,
                $application->email,
                $application->phone,
                $application->position,
                now()->toDateTimeString(),
                now()->toDateTimeString(),
                now()->toDateTimeString()
            ]);

            // Raw query to update application status to 'approved'
            DB::update("UPDATE staff_applications SET status = 'approved', updated_at = ? WHERE id = ?", [now()->toDateTimeString(), $id]);

            return redirect()->back()->with('success', 'Staff application approved successfully!');
        }

        return redirect()->back()->with('error', 'Application not found.');
    }

    public function declineStaff($id)
    {
        $this->authorizeAdmin();

        // Raw query to delete application
        DB::delete('DELETE FROM staff_applications WHERE id = ?', [$id]);

        return redirect()->back()->with('success', 'Staff application declined and removed.');
    }
}
