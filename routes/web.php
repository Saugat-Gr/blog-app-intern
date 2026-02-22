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

Route::prefix('admin')->controller(AdminController::class)->group(function(){

        Route::get('requests', 'renderUserRequest')->name('admin.user.request');
        Route::get('dashboard',  'dashboard')->name('admin.dashboard');
        Route::patch('updateRequest/{userRequest}/approve', 'accUserRequest')->name('admin.request.approve');
        Route::patch('updateRequest/{userRequest}/reject', 'declineUserRequest')->name('admin.request.reject');
        Route::get('users/filter', 'filterUsers')->name('admin.users.filter');

});

Route::resource('admin', AdminController::class);
Route::resource('user', UserController::class);

