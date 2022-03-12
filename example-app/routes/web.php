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

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index' ] );

Route::get( '/home', [\App\Http\Controllers\HomeController::class, 'index' ] );

Route::get( '/login', [\App\Http\Controllers\LoginController::class, 'index' ] );
Route::get( '/registration', [\App\Http\Controllers\RegistrationController::class, 'create' ] );
Route::post('registration', [\App\Http\Controllers\RegistrationController::class, 'store' ] );

Route::get( '/folders', [\App\Http\Controllers\FoldersController::class, 'index' ] );
