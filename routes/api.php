<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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



Route::get(
    '/user/profile',
    [UserController::class, 'index']
)->name('profile');


Route::post(
    '/user/store',
    [UserController::class, 'create']
)->name('store');

Route::put(
    '/user/update',
    [UserController::class, 'update']
)->name('update');

Route::delete(
    '/user/delete',
    [UserController::class, 'destroy']
)->name('delete');
