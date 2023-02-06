<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
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

Route::controller(RegisterController::class)->group(function(){
    Route::post('/register', 'register');
    Route::post('/login', 'login')->name('login');
    Route::post('/logout' , 'logout')->middleware('auth:sanctum');
    Route::get('/getAllUsers','getUsers');
    Route::get('/getUser/{id}','getUser');
    Route::post('/updateInfo/{id}','updateInfo');
    Route::post('/updateImage/{id}','updateImage');
});

Route::controller(PostController::class)->group(function(){
    Route::get('/posts', 'index');
    Route::get('/posts/{id}', 'show');
    Route::post('/addPost' , 'store')->middleware('auth:sanctum');
});

Route::controller(CategoryController::class)->group(function(){
    Route::get('/categories', 'index');
    Route::get('/categories/{id}', 'show');
});



