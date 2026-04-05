<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\FoodItem;
use App\Models\Voucher;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $branches = Branch::limit(5)->get();
        $foodItems = FoodItem::limit(5)->get();
        $vouchers = Voucher::where('valid_until', '>=', today())
                           ->whereRaw('uses < max_uses')
                           ->latest()
                           ->limit(3)
                           ->get();
        return view('home', compact('branches', 'foodItems', 'vouchers'));
    }
}
