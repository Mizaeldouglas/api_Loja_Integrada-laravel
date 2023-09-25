<?php

use App\Http\Controllers\api\CupomController;
use App\Http\Controllers\api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('/v1')->group(function () {
    Route::resource('/products', ProductController::class)->only([
        'index', 'show', 'store', 'update', 'destroy'
    ]);

    Route::resource('/cupons', CupomController::class)->only([
        'index', 'show', 'store', 'update', 'destroy'
    ]);
});
