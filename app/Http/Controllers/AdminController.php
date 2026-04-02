<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('admin.foods');
    }

    public function vouchers()
    {
        $this->authorizeAdmin();
        return view('admin.vouchers');
    }

    public function reviews()
    {
        $this->authorizeAdmin();
        return view('admin.reviews');
    }

    public function reports()
    {
        $this->authorizeAdmin();
        return view('admin.reports');
    }

    public function staffs()
    {
        $this->authorizeAdmin();
        return view('admin.staffs');
    }
}
