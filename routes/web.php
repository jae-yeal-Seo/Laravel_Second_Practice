<?php

use App\Http\Controllers\CommentsController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resource('/posts', PostsController::class)->middleware(['auth']);

Route::delete('/posts/images/{id}', [PostsController::class, 'deleteImage'])->middleware(['auth']);

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::post('/like/{post}', [LikesController::class, 'store'])->middleware(['auth'])->name('like.store');

Route::post('comments/{post}', [CommentsController::class, 'store'])->middleware(['auth'])->name('comment.store');
Route::get('comments/{post}', [CommentsController::class, 'index'])->name('comment.index');
Route::put('comments/{post}/{comment}', [CommentsController::class, 'update'])->middleware(['auth'])->name('comment.update');
Route::delete('comments/{post}/{comment}', [CommentsController::class, 'destroy'])->middleware(['auth'])->name('comment.destroy');

require __DIR__ . '/auth.php';
