<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthManagerController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\Auth\AuthUserController;
use App\Http\Controllers\Auth\AuthEmployerController;

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
    return view('welcome');
})->name('index');

Route::group(['prefix' => 'manager'], function () {
    Route::get('login', [AuthManagerController::class, 'showLoginForm'])->name('manager.show-login-form');
    Route::post('login', [AuthManagerController::class, 'login'])->name('manager.login');

    Route::get('dashboard', [ManagerController::class, 'dashboard'])->name('manager.dashboard');

    Route::get('create-manager', [ManagerController::class, 'showCreateManageForm'])->name('manager.show-create-manager-form');
    Route::post('create-manager', [ManagerController::class, 'createManage'])->name('manager.create-manager');
});

Route::group(['prefix' => 'user'], function () {
    Route::get('login', [AuthUserController::class, 'showLoginForm'])->name('user.show-login-form');

    Route::post('login', [AuthUserController::class, 'login'])->name('user.login');
});

Route::group(['prefix' => 'employer'], function () {
    Route::get('login', [AuthEmployerController::class, 'showLoginForm'])->name('employer.show-login-form');

    Route::post('login', [AuthEmployerController::class, 'login'])->name('employer.login');
});
