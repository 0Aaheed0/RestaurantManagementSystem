<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StaffController;

Route::post('/apply-staff', [StaffController::class, 'apply']);
Route::get('/approve-staff/{id}', [StaffController::class, 'approve']);
Route::get('/apply-staff', function () {
    return view('apply-staff');
});
Route::get('/reject-staff/{id}', [StaffController::class, 'reject']);
Route::get('/', function () {
    return view('welcome');
})->middleware('guest');



// Protected routes (after login)
use App\Http\Controllers\ReportController;

Route::middleware(['auth', 'no-cache'])->group(function () {

    Route::view('/home', 'home')->name('home');
    Route::get('/dashboard', function () {
        return view('home');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/report', [ReportController::class, 'create'])->name('report.create');
    Route::post('/report', [ReportController::class, 'store'])->name('report.store');
});

require __DIR__.'/auth.php';
