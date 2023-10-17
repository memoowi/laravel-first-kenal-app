<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TestController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Redirect ke url 'posts'
Route::get('/', function () {
    return redirect()->route('posts.index');
});
// URL posts
Route::resource('posts', PostController::class);
Route::post('posts/store2',[PostController::class, 'store2'])->name('posts.store2');

Route::get('comments',[CommentController::class, 'index'])->name('comments.index');
Route::post('comments/{post_id}',[CommentController::class, 'store'])->name('comments.store');






// BELAJAR
// First route
Route::get('/uwu/{name}', function ($name) {
    $age=20;
    return view('hello',compact('name','age'));
});

// Second route
Route::get('/owo/{name}', function ($name) {
    $age=55;
    return view('hello', [
        'name' => $name,
        'age' => $age,
    ]);
});

// Third route
Route::get('/iwi/{name}', [TestController::class, 'test']);

//Query Builder Route
Route::get('/query', [TestController::class, 'queryBuilder']);

//Eloquent Route
Route::get('/elo', [TestController::class, 'eloquent']);