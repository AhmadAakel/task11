<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
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

Route::middleware(['auth'])->group(function () {
     //users
     Route::middleware(['admin'])->group(function () {
     Route::get('user', [UserController::class, 'index'])->name('users.index');
     Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
     Route::get('user/create', [UserController::class, 'create'])->name('users.create');
     Route::get('user/trush', [UserController::class, 'trash'])->name('users.trash');
     Route::delete('users/{id}/force-delete', [UserController::class, 'forceDelete'])->name('users.forceDelete');
     Route::patch('users/{id}/restore', [UserController::class, 'restore'])->name('users.restore');
     Route::post('users', [UserController::class, 'store'])->name('users.store');
     Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
     Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
     Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
     Route::delete('users/{user}/Delete', [UserController::class, 'Delete'])->name('users.Delete');
     
    });
    //posts
    Route::middleware(['can:delete,post'])->delete('posts/{post}/delete', [PostController::class, 'Delete'])->name('posts.Delete');
    Route::middleware(['can:viewAny,App\Models\Post'])->get('', [PostController::class, 'index'])->name('posts.index');
    Route::middleware(['can:view,post'])->get('posts/{post}', [PostController::class, 'show'])->name('posts.show');
    Route::middleware(['can:create,App\Models\Post'])->get('post/create', [PostController::class, 'create'])->name('posts.create');
    Route::middleware(['can:create,App\Models\Post'])->post('posts', [PostController::class, 'store'])->name('posts.store');
    Route::middleware(['can:update,post'])->get('posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::middleware(['can:update,post'])->put('posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::middleware(['admin'])->group(function () {
    //post archive
    Route::delete('posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::patch('posts/{id}/restore', [PostController::class, 'restore'])->name('posts.restore');
    Route::get('post/trush', [PostController::class, 'trash'])->name('posts.trash');
});

    //logout
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    
    
    //comments
    Route::middleware(['can:create,App\Models\Comment'])->get('comment/create', [CommentController::class, 'create'])->name('comments.create');
    Route::middleware(['can:create,App\Models\Comment'])->post('comments/{post}', [CommentController::class, 'store'])->name('comments.store');
    Route::middleware(['can:update,comment'])->get('comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
    Route::middleware(['can:update,comment'])->put('comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::middleware(['can:delete,comment'])->delete('comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');


    //category
    Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
    Route::middleware(['admin'])->group(function () {
    Route::get('category/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    });


     //tag
     Route::get('tags', [TagController::class, 'index'])->name('tags.index');
     Route::get('tags/{tag}', [TagController::class, 'show'])->name('tags.show');
     Route::middleware(['admin'])->group(function () {
     Route::get('tag/tag', [TagController::class, 'create'])->name('tags.create');
     Route::post('tags', [TagController::class, 'store'])->name('tags.store');
     Route::get('tags/{tag}/edit', [TagController::class, 'edit'])->name('tags.edit');
     Route::put('tags/{tag}', [TagController::class, 'update'])->name('tags.update');

     Route::delete('tags/{tag}', [TagController::class, 'destroy'])->name('tags.destroy');
     });
});
Route::middleware(['guest'])->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    /* Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [AuthController::class, 'register']); */
});

