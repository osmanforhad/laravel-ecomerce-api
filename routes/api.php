<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum', 'isAPIAdmin'])->group(function () {
    Route::get('/checkingAuthenticated', function() {
        return response()->json(['message'=>'You are in', 'status=>200'], 200);
    });

    Route::post('store_category', [CategoryController::class, 'store']);
    Route::get('category_list', [CategoryController::class, 'index']);
    Route::get('edit_category/{id}', [CategoryController::class, 'edit']);
    Route::put('update_category/{id}', [CategoryController::class, 'update']);
    Route::delete('delete_category/{id}', [CategoryController::class, 'destroy']);

});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
});
