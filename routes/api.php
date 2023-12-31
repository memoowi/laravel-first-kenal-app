<?php

use App\Http\Controllers\Api\PostController;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('posts', [PostController::class, 'index']);
Route::get('post/{post_id}', [PostController::class, 'show']);
Route::post('posts', [PostController::class, 'store']);
Route::post('update/post/{post_id}', [PostController::class, 'update']);
Route::delete('delete/post/{post_id}', [PostController::class, 'destroy']);
