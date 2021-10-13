<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CatController;
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

Route::post('/register', [AuthController::class,'Register']);
Route::post('/login', [AuthController::class,'Login']);
Route::post('addproduct' , [ProductController::class , 'addProduct']);
Route::get('showallproducts' , [ProductController::class , 'showAllProducts']);
Route::delete('deleteproduct/{id}' , [ProductController::class , 'deleteProduct']);
Route::get('getproduct/{id}' , [ProductController::class , 'getProduct']);
Route::post('updateproduct/{id}' , [ProductController::class , 'updateProduct']);
Route::get('search/{key}' , [ProductController::class , 'Search']);

Route::post('/createCat', [CatController::class,'addCat']);
Route::get('/showCats', [CatController::class,'ShowAllCat']);

Route::get('Showcat/{id}' , [CatController::class , 'ShowCat']);
Route::get('showAllProductsofCat/{id}' , [ProductController::class , 'showAllProductsofCat']);


// ShowCat
// ShowAllCat
// showAllProductsofCat
Route::group(['middleware'=>['auth:sanctum']], function(){
    Route::post('/logout', [AuthController::class,'Logout']);

});


