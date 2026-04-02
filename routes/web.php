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

    // Admin Dashboard routes
    Route::get('/admin/dashboard', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/foods', [\App\Http\Controllers\AdminController::class, 'foods'])->name('admin.foods');
    Route::post('/admin/foods/add', [\App\Http\Controllers\AdminController::class, 'addFood'])->name('admin.foods.add');
    Route::post('/admin/foods/update/{id}', [\App\Http\Controllers\AdminController::class, 'updateFood'])->name('admin.foods.update');
    Route::post('/admin/foods/delete/{id}', [\App\Http\Controllers\AdminController::class, 'deleteFood'])->name('admin.foods.delete');
    Route::get('/admin/orders', [\App\Http\Controllers\AdminController::class, 'orders'])->name('admin.orders');
    Route::post('/admin/orders/update-status/{id}', [\App\Http\Controllers\AdminController::class, 'updateOrderStatus'])->name('admin.orders.update-status');
    Route::get('/admin/vouchers', [\App\Http\Controllers\AdminController::class, 'vouchers'])->name('admin.vouchers');
    Route::post('/admin/vouchers/add', [\App\Http\Controllers\AdminController::class, 'addVoucher'])->name('admin.vouchers.add');
    Route::post('/admin/vouchers/delete/{id}', [\App\Http\Controllers\AdminController::class, 'deleteVoucher'])->name('admin.vouchers.delete');
    Route::get('/admin/reviews', [\App\Http\Controllers\AdminController::class, 'reviews'])->name('admin.reviews');
    Route::post('/admin/reviews/delete/{id}', [\App\Http\Controllers\AdminController::class, 'deleteReview'])->name('admin.reviews.delete');
    Route::get('/admin/reports', [\App\Http\Controllers\AdminController::class, 'reports'])->name('admin.reports');
    Route::post('/admin/reports/solve/{id}', [\App\Http\Controllers\AdminController::class, 'solveReport'])->name('admin.reports.solve');
    Route::get('/admin/faqs', [\App\Http\Controllers\AdminController::class, 'faqs'])->name('admin.faqs');
    Route::post('/admin/faqs/add', [\App\Http\Controllers\AdminController::class, 'addFaq'])->name('admin.faqs.add');
    Route::post('/admin/faqs/delete/{id}', [\App\Http\Controllers\AdminController::class, 'deleteFaq'])->name('admin.faqs.delete');
    Route::get('/admin/branches', [\App\Http\Controllers\AdminController::class, 'branches'])->name('admin.branches');
    Route::post('/admin/branches/add', [\App\Http\Controllers\AdminController::class, 'addBranch'])->name('admin.branches.add');
    Route::post('/admin/branches/update/{id}', [\App\Http\Controllers\AdminController::class, 'updateBranch'])->name('admin.branches.update');
    Route::post('/admin/branches/delete/{id}', [\App\Http\Controllers\AdminController::class, 'deleteBranch'])->name('admin.branches.delete');
    Route::get('/admin/staffs', [\App\Http\Controllers\AdminController::class, 'staffs'])->name('admin.staffs');
    Route::post('/admin/staffs/approve/{id}', [\App\Http\Controllers\AdminController::class, 'approveStaff'])->name('admin.staffs.approve');
    Route::post('/admin/staffs/decline/{id}', [\App\Http\Controllers\AdminController::class, 'declineStaff'])->name('admin.staffs.decline');
});

require __DIR__.'/auth.php';
