<?php

use App\Http\Controllers\API\PostsController;
use App\Http\Controllers\API\RoleController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\UserController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register'])->middleware('auth:sanctum');
Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');

Route::post('role/add',[RoleController::class,'create'])->middleware('auth:sanctum');
Route::get('role/index',[RoleController::class,'index'])->middleware('auth:sanctum');
Route::get('role/edit',[RoleController::class,'edit'])->middleware('auth:sanctum');
Route::post('role/update',[RoleController::class,'update'])->middleware('auth:sanctum');
Route::get('role/delete',[RoleController::class,'delete'])->middleware('auth:sanctum');


Route::get('user/index',[UserController::class,'index'])->middleware('auth:sanctum');
Route::get('user/edit',[UserController::class,'edit'])->middleware('auth:sanctum');
Route::get('user/delete',[UserController::class,'delete'])->middleware('auth:sanctum');
Route::post('user/update',[UserController::class,'update'])->middleware('auth:sanctum');


// Route::group(['prefix' => 'posts','middleware' => 'auth:sanctum'], function() {
//     Route::get('/', [PostsController::class,'index']);
//     Route::post('add', [PostsController::class,'add']);
//     Route::post('update/{id}', [PostsController::class,'update']);
//     Route::get('edit/{id}', [PostsController::class,'edit']);
//     Route::delete('delete/{id}', [PostsController::class,'delete']);
// });

