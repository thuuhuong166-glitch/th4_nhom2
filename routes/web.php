<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome'); // tạm thời, sẽ thay ở commit 3
Route::prefix('admin')->group(function () {
    Route::view('/posts', 'admin.stub'); // tạm, sẽ thay ở commit 5
});
