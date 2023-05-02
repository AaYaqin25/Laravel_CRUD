<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginLogoutController;
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

Route::middleware(['session'])->group(function() {

    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    Route::get('/users/data', [UserController::class, 'showDataTables'])->name('users.data');

    Route::get('/users/add', [UserController::class, 'showadd'])->name('users.store');

    Route::get('/users/edit/{id}', [UserController::class, 'showupdate'])->name('users.edit');

    Route::get('/users/{id}', [UserController::class, 'show']);

    Route::get('/users/delete/{id}', [UserController::class, 'destroy'])->name('users.delete');

});


Route::post('/users/add', [UserController::class, 'store'])->name('users.create');

Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');

Route::get('/login', [LoginLogoutController::class, 'formLogin'])->name('formlogin');

Route::post('/login/post', [LoginLogoutController::class, 'login'])->name('login');

Route::get('/logout', [LoginLogoutController::class, 'logout'])->name('logout');
