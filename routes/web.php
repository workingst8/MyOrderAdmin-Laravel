<?php

use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;

// === 페이지 ===
Route::view('/items/create', 'items_create')->name('item.create');



// === 어드민 API ===

//아이템 CRUD
Route::get('/items', [ItemController::class, 'getAllItems'])->name('item.all');
Route::post('/items', [ItemController::class, 'createItem']);
Route::post('/items/{id}', [ItemController::class, 'updateItem']);
Route::delete('/items/{id}', [ItemController::class, 'deleteItem']);



// === 서비스 API ===
Route::get('/api/v1/Items',[ItemController::class, 'getAllItemsApi']);
