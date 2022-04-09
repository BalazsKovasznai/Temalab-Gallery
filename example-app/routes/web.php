<?php

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

Route::get('/', function () {
    return view('home_screen');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/albums', [\App\Http\Controllers\AlbumsController::class,'index']);
Route::resource('albums', \App\Http\Controllers\AlbumsController::class);
Route::resource('users', \App\Http\Controllers\ShareController::class);
Route::get('/albums/create',[\App\Http\Controllers\AlbumsController::class,'create'])->name('album-create');
Route::post('/albums/store',[\App\Http\Controllers\AlbumsController::class,'store'])->name('album-store');
Route::get('/albums/{id}',[\App\Http\Controllers\AlbumsController::class,'show'])->name('album-show');

Route::get('/photos/create/{albumId}',[\App\Http\Controllers\PhotosController::class,'create'])->name('photo-create');
Route::post('/photos/store',[\App\Http\Controllers\PhotosController::class,'store'])->name('photo-store');
Route::get('/photos/{id}',[\App\Http\Controllers\PhotosController::class,'show'])->name('photo-show');
Route::delete('/photos/{id}',[\App\Http\Controllers\PhotosController::class,'destroy'])->name('photo-destroy');
Route::delete('/albums/{id}',[\App\Http\Controllers\AlbumsController::class,'destroy'])->name('album-destroy');


Route::get('/sharedalbums', [\App\Http\Controllers\ShareController::class,'index'])->name('album-shared-with');
Route::get('/albums/{albumId}/share', [\App\Http\Controllers\ShareController::class,'create'])->name('album-share-create');
Route::post('/share',[\App\Http\Controllers\ShareController::class,'add'])->name('album-share-add');
Route::get('/albums/{id}/shared_with_users',[\App\Http\Controllers\ShareController::class,'list_users'])->name('album-share-list');
Route::delete('/albums/{albumid}/shared_with_users',[\App\Http\Controllers\ShareController::class,'destroy'])->name('sharing-destroy');


Route::get('/sharedalbums/{id}',[\App\Http\Controllers\ShareController::class,'show'])->name('album-share-show');
Route::get('/shared_photos/{id}',[\App\Http\Controllers\ShareController::class,'shared_photo_show'])->name('shared-photo-show');

Route::post('/comment_owner',[\App\Http\Controllers\CommentsController::class,'store_as_owner'])->name('comment-store-as-owner');
Route::post('/comment_user',[\App\Http\Controllers\CommentsController::class,'store_as_user'])->name('comment-store-as-user');
Route::delete('/comment_destroy_user',[\App\Http\Controllers\CommentsController::class,'destroy_as_user'])->name('comment-destroy-as-user');
Route::delete('/comment_destroy_owner',[\App\Http\Controllers\CommentsController::class,'destroy_as_owner'])->name('comment-destroy-as-owner');

require __DIR__.'/auth.php';
