<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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
// -------------------
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



// ------------------------ Product Routes ----------------------
Route::get('/products',[ProductController::class,'get_all']);

Route::post('/product/create',[ProductController::class , 'create']);
// Route::post('/product/show/{id}',[ProductController::class , 'show']);
Route::post('/product/show',[ProductController::class , 'show']);
Route::post('/product/update/{id}',[ProductController::class , 'update']);



// ------------------------ User Routes ----------------------
Route::post('/user/store',[UserController::class , 'store']);
Route::get('/users',[UserController::class,'index']);



// ------------------------- Login ------------------------
Route::post('/login',[UserController::class , 'login']);

// ------------------ new route
// Route::post('/login',[UserController::class , 'login']);
// Route::post('/login',[UserController::class , 'login']);



// ------------------------- Write By YAhia ------------------------
Route::post('/forget_password',[UserController::class , 'forget_password']);
