<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/csrf_token', function () {
    return response()->json(['csrf_token' => csrf_token()]);
});

Route::get('/users', [UserController::class, 'index'])->name('users.index');

Route::get('/users/add', [UserController::class, 'showadd'])->name('users.store');

Route::get('/users/edit/{id}', [UserController::class, 'showupdate'])->name('users.edit');

Route::get('/users/{id}', [UserController::class, 'show']);

Route::post('/users/add', [UserController::class, 'store'])->name('users.create');

Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');

Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.delete');
