<?php

use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;

// === 어드민 ===

//로그인
Route::middleware('guest:admin')->group(function () {
    Route::view('/', 'login');
    Route::get('/login', [LoginController::class, 'loginForm'])->name('login-form');
    Route::post('/login', [LoginController::class, 'login'])->name('login');
});
Route::get('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth:admin');

//비밀번호 변경
Route::middleware('auth:admin')->group(function(){
    Route::view('/password','pw_change')->name('pw-form')->middleware('auth:admin');
    Route::post('/password', [AdminController::class, 'changePassword'])->name('pw.update')->middleware('auth:admin');
});

//아이템
Route::middleware('auth:admin')->group(function(){
    Route::get('/items', [ItemController::class, 'getAllItems'])->name('item.all');
    Route::post('/items/{id}', [ItemController::class, 'updateItem']);
    Route::delete('/items/{id}', [ItemController::class, 'deleteItem']);
    Route::view('/items/new', 'items_create')->name('item.create');
    Route::post('/items', [ItemController::class, 'createItem']);
});




// === 서비스 ===
Route::get('/api/v1/items', [ItemController::class, 'getAllItemsApi']);
