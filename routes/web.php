<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthManagerController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\RoleController;
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


// quản lý tài khoản manager
Route::group(['prefix' => 'manager'], function () {
    // đămg nhập của mangager
    Route::get('login', [AuthManagerController::class, 'showLoginForm'])->name('manager.show-login-form');
    Route::post('login', [AuthManagerController::class, 'login'])->name('manager.login');

    // màn dashboard
    Route::get('index', [ManagerController::class, 'showAllManagers'])->name('manager.dashboard')->middleware('manager:read_manager');

    // chức năng tạo tài khoản quản lý mới,bọc kèm middleware kiểm tra quyền tạo mới
    Route::group(['middleware' => 'manager:create_manager'],function (){
        Route::get('create-manager', [ManagerController::class, 'showCreateManageForm'])->name('manager.show-create-manager-form');
        Route::post('create-manager', [ManagerController::class, 'createManage'])->name('manager.create-manager');
    });

    // chức năng cập nhật thông tin quản lý,bọc bởi middlware kiểm tra quyền cập nhật
    Route::group(['middleware' => 'manager:update_manager'],function (){
        Route::get('update-manager/{id}',[ManagerController::class, 'showUpdateManagerForm'])->name('manager.show-update-manager-form');
        Route::post('update-manager/{id}',[ManagerController::class, 'updateManager'])->name('manager.update-manager');
    });
});

Route::group(['prefix' => 'role'],function (){
    Route::get('index', [RoleController::class, 'showAllRoles'])->name('manager.dashboard')->middleware('manager:read_role');
});


Route::group(['prefix' => 'user'], function () {
    Route::get('login', [AuthUserController::class, 'showLoginForm'])->name('user.show-login-form');

    Route::post('login', [AuthUserController::class, 'login'])->name('user.login');
});

Route::group(['prefix' => 'employer'], function () {
    Route::get('login', [AuthEmployerController::class, 'showLoginForm'])->name('employer.show-login-form');
    Route::post('login', [AuthEmployerController::class, 'login'])->name('employer.login');

    Route::get('create_post',[PostController::class,'showCreatePostForm'])->name('employer.create-post');
});
