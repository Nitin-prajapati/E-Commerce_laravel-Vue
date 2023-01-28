<?php

use App\Http\Controllers\API\authController;
use App\Http\Controllers\API\itemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\userController;
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

Route::controller(authController::class)->group(function(){
    Route::post('login','login');
    Route::post('register','register');
});


Route::controller(itemController::class)->group(function(){
    Route::get('getItems',[itemController::class,'getItems']);
    Route::get('getItemWithId/{id}',[itemController::class,'getItemWithId']);
});


Route::post('placeOrder',[OrderController::class,'store']);

Route::post('updateUser/{id}',[userController::class,'update']);
