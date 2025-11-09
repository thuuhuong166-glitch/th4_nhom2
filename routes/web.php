<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\PostController as FrontPostController;
use App\Http\Controllers\Admin\PostController as AdminPostController;

// Frontend
Route::get('/',               [FrontPostController::class, 'index'])->name('home');
Route::get('/posts',          [FrontPostController::class, 'index'])->name('front.posts.index');
Route::get('/posts/{slug}',   [FrontPostController::class, 'show'])->name('front.posts.show');

// Admin (demo không gắn auth, bạn có thể thêm middleware 'auth' sau)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('posts', AdminPostController::class)->except(['show']);
});
