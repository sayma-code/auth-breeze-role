<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth', 'verified', 'role:1'])->prefix('user')->name('user.')->group(function() {
        Route::get('/entry-time', [UserController::class, 'index'])->name('entrytime');
    });

Route::middleware(['auth', 'verified', 'role:2'])->prefix('admin')->name('admin.')->group(function() {
        Route::get('/user', [AdminController::class, 'index'])->name('users');
    });

Route::middleware(['auth', 'verified', 'role:3'])->prefix('superadmin')->name('superadmin.')->group(function() {
        Route::get('/admin', [SuperAdminController::class, 'index'])->name('admins');
    });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
