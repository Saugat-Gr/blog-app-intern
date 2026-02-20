<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('auth.login');
});


Route::get('/login', function(){
      return view('auth.login');
})->name('login.show');

Route::post('/login', [LoginController::class,'authenticate'])->name('auth.login');
Route::post('/logout', [LoginController::class,'logout'])->name('auth.logout');
Route::post('/register', [LoginController::class,'register'])->name('auth.register');

Route::get('admin/requests', [AdminController::class,'userRequest'])->name('admin.user.request');
Route::resource('user', UserController::class);
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::resource('admin', AdminController::class);