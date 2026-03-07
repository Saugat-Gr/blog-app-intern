<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('auth.login');
});

Route::get('/dashboard', [PostController::class, 'guestPosts'])->name('dashboard');

Route::get('/login', function () {
    return view('auth.login');
})->name('login.show');

Route::post('/login', [LoginController::class, 'authenticate'])->name('auth.login');
Route::post('/logout', [LoginController::class, 'logout'])->name('auth.logout');
Route::post('/register', [LoginController::class, 'register'])->name('auth.register');

// UserController:


Route::prefix('admin')->controller(AdminController::class)->middleware('role:admin|super-admin')->group(function () {

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


    Route::name('admin.')->group(function () {
        //  Plan Controller: 
        Route::resource('plan', PlanController::class);
        
        // PostController:
        Route::resource('post', PostController::class);
        });

        Route::get('plan/filter/{status}', [PlanController::class, 'filterPlans'])->name('admin.plans.filter');
        Route::get('post/filter/{status}', [PostController::class, 'filterPosts'])->name('admin.posts.filter');

    

});

Route::resource('admin', AdminController::class);
Route::resource('user', UserController::class)->only(['index', 'edit', 'update']);

Route::get('/user/{user}/posts', [UserController::class, 'showUserPosts'])->name('user.posts');
Route::get('/user/create-post', [UserController::class, 'createPost'])->name('user.posts.create');
Route::post('/user/{user}/posts', [UserController::class, 'storePost'])->name('user.posts.store');
Route::get('/user/{user}/posts/{post}/edit', [UserController::class, 'editPost'])->name('user.posts.edit');
Route::patch('/user/{user}/posts/{post}/update', [UserController::class, 'updatePost'])->name('user.posts.update');
Route::get('posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');


Route::get('/send-email', [EmailController::class, 'sendEmail'])->name('send.email');

// Route::get('/test', function(){
//     $email = 'gganosh9@test.com';
//         $apiKey = env('EMAILVERIFY_API_KEY');
//     $response = Http::get(
//     "https://app.emailverify.io/api/v1/validate?key={$apiKey}&email={$email}"
// );
//   return $response->json();
// });

