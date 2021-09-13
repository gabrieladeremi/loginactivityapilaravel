<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LoginRecordsController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

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


Route::post('/', [RegistrationController::class, 'register'])->name('user.register');

Route::post('/login', [LoginController::class, 'login'])->name('user.login');

Route::middleware('auth:api')
        ->group(static function () {

            Route::get('/', [LoginRecordsController::class, 'records'])->name('login.records');

            Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

        });

