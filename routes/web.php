<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\ReviewController;

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

Route::post('/apply-staff', [StaffController::class, 'apply']);
Route::get('/approve-staff/{id}', [StaffController::class, 'approve']);
Route::get('/apply-staff', function () {
    return view('apply-staff');
})->name('staff.apply');
Route::get('/reject-staff/{id}', [StaffController::class, 'reject']);

Route::get('/branches', [BranchController::class, 'index'])->name('branches.index');
Route::get('/food', [FoodController::class, 'index'])->name('food.index');
Route::get('/faq', [FaqController::class, 'index'])->name('faq');

Route::get('/', function () {
    return view('welcome');
})->middleware('guest');



// Protected routes (after login)
use App\Http\Controllers\ReportController;

use App\Http\Controllers\HomeController;

Route::middleware(['auth', 'no-cache'])->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/report', [ReportController::class, 'create'])->name('report.create');
    Route::post('/report', [ReportController::class, 'store'])->name('report.store');

    Route::get('/review', [ReviewController::class, 'index'])->name('review.index');
    Route::post('/review', [ReviewController::class, 'store'])->name('review.store');

    // Cart routes
    Route::get('/cart', [CartController::class,'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class,'add'])->name('cart.add');
    Route::delete('/cart/remove/{id}', [CartController::class,'remove'])->name('cart.remove');

    // Orders & Checkout routes
    Route::get('/checkout', [OrderController::class,'showCheckout'])->name('checkout');
    Route::post('/checkout/apply-voucher', [OrderController::class,'applyVoucher'])->name('checkout.apply-voucher');
    Route::post('/checkout/remove-voucher', [OrderController::class,'removeVoucher'])->name('checkout.remove-voucher');
    Route::post('/checkout/process', [OrderController::class,'processPayment'])->name('checkout.process');
    Route::get('/orders/history', [OrderController::class,'history'])->name('orders.history');
});

require __DIR__.'/auth.php';
