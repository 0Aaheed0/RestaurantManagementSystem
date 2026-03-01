<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\FaqController;

Route::post('/apply-staff', [StaffController::class, 'apply']);
Route::get('/approve-staff/{id}', [StaffController::class, 'approve']);
Route::get('/apply-staff', function () {
    return view('apply-staff');
})->name('staff.apply');
Route::get('/reject-staff/{id}', [StaffController::class, 'reject']);

Route::get('/branches', [BranchController::class, 'index'])->name('branches.index');
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
});

require __DIR__.'/auth.php';
