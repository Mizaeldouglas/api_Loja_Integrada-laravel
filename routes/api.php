<?php

use App\Http\Controllers\api\CartController;
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

    Route::resource('/carts', CartController::class)->only([
        'index', 'show', 'store', 'update', 'destroy'
    ]);


    Route::post('/cart/{session_id}', [CartController::class, 'adicionarProdutoAoCarrinho']);
    Route::post('/cart/{session_id}/add-coupon-product/{cupom}', [CartController::class, 'adicionarCupomEProdutoAoCarrinho']);
    Route::get('/cart/{session_id}', [CartController::class, 'buscarCarrinhoPorSessionId']);
    Route::delete('/cart/{session_id}/{id}', [CartController::class, 'deleterCupomEProdutoNoCarrinho']);
    Route::put('/cart/{seesion_id}/{id}', [CartController::class, 'atualizarCupomEProdutoNoCarrinho']);
});
