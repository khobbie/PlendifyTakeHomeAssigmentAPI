<?php

use App\Http\Controllers\CurrencySetupController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/setup-currency-rates', [CurrencySetupController::class, 'setupCurrencyRates']);


Route::post('/search-product', [ProductController::class, 'searchProduct']);
Route::post('/product', [ProductController::class, 'addProduct']);
Route::put('/product/{product_id}', [ProductController::class, 'updateProduct']);
Route::delete('/product/{product_id}', [ProductController::class, 'deleteProduct']);
Route::get('/product/{product_id}', [ProductController::class, 'getSingleProduct']);
Route::get('/product', [ProductController::class, 'getListOfProduct']);