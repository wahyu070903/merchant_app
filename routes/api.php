<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Models\Products;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('product')->group(function () {
    Route::get('/get/{id}',[ProductsController::class, 'get']);
    Route::get('/getrange/{start}/{length}',[ProductsController::class, 'getRange']);
    Route::get('/count',[ProductsController::class,'countData']);
    Route::post('/add',[ProductsController::class, 'add']);
    Route::patch('/update/{id}',[ProductsController::class, 'update']);
    Route::delete('/destroy/{id}',[ProductsController::class, 'destroy']);
});

