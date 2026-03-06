<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('auth.login');
});


Route::get('/login', function () {
    return view('auth.login');
})->name('login.show');

Route::post('/login', [LoginController::class, 'authenticate'])->name('auth.login');
Route::post('/logout', [LoginController::class, 'logout'])->name('auth.logout');
Route::post('/register', [LoginController::class, 'register'])->name('auth.register');

Route::prefix('admin')->controller(AdminController::class)->middleware('can:isAdmin')->group(function () {

    Route::get('requests', 'renderUserRequest')->name('admin.user.request');
    Route::get('dashboard', 'dashboard')->name('admin.dashboard');


    //  Admin Action to Users:

    // 1. Accepting/Approving Users
    Route::patch('updateRequest/{userRequest}/approve', 'accUserRequest')->name('admin.request.approve');
    Route::patch('updateRequest/{userRequest}/reject', 'declineUserRequest')->name('admin.request.reject');

    // 2. Filtering Users:
    Route::get('users/filter', 'filterUsers')->name('admin.users.filter');

    //  3. CRUD Opeartion on users:
    Route::get('user/create', 'createUser')->name('admin.user.create');
    Route::get('user/{user}/edit', 'editUser')->name('admin.user.edit');
    Route::patch('user/{user}/update', 'updateUser')->name('admin.user.update');
    Route::delete('user/{user}/destroy', 'destroyUser')->name('admin.user.destroy');
    Route::patch('user/{user}/suspend', 'suspendUser')->name('admin.user.suspend');


    //  Plan Controller: 
    Route::name('admin.')->group(function () {
        Route::resource('plan', PlanController::class);
    });
    Route::get('plan/filter/{status}', [PlanController::class, 'filterPlans'])->name('admin.plans.filter');


});

Route::resource('admin', AdminController::class);
Route::resource('user', UserController::class);

Route::get('/send-email', [EmailController::class, 'sendEmail'])->name('send.email');

// Show form to request password reset
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');

// Handle sending reset link
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])
    ->name('password.email');

// Show form to reset password (user clicks link)
// Show reset form
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])
    ->name('password.reset');

// Handle reset form submission
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])
    ->name('password.update');