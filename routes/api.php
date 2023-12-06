<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\user\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::get('token/validate', [AuthController::class, 'verifyToken']);

Route::post('register',[Authcontroller::class,'register']);
Route::post('login',[Authcontroller::class,'login']);


Route::middleware('jwt.verify')->group(function (){
    Route::post('/upload', [ImageController::class, 'uploadImage']);

    // Routes to posts
    //Route::get('posts', [PostController::class, 'index']);
    Route::post('createPost', [PostController::class, 'store']);

});
//Route::post('register',[Authcontroller::class,'register']);
Route::get('users',[UserController::class,'index']);
Route::get('posts', [PostController::class, 'index']);


