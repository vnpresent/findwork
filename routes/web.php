<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthManagerController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Auth\AuthApplicantController;
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

Route::get('/', [IndexController::class, 'index'])->name('index');


// quản lý tài khoản manager
Route::group(['prefix' => 'manager'], function () {
    // đămg nhập của mangager
    Route::get('login', [AuthManagerController::class, 'showLoginForm'])->name('manager.show-login-form');
    Route::post('login', [AuthManagerController::class, 'login'])->name('manager.login');

    // màn dashboard
    Route::get('index', [ManagerController::class, 'showAllManagers'])->name('manager.dashboard')->middleware('manager:read_manager');

    // chức năng tạo tài khoản quản lý mới,bọc kèm middleware kiểm tra quyền tạo mới
    Route::group(['middleware' => 'manager:create_manager'], function () {
        Route::get('create-manager', [ManagerController::class, 'showCreateManageForm'])->name('manager.show-create-manager-form');
        Route::post('create-manager', [ManagerController::class, 'createManage'])->name('manager.create-manager');
    });

    // chức năng cập nhật thông tin quản lý,bọc bởi middlware kiểm tra quyền cập nhật
    Route::group(['middleware' => 'manager:update_manager'], function () {
        Route::get('update-manager/{id}', [ManagerController::class, 'showUpdateManagerForm'])->name('manager.show-update-manager-form');
        Route::post('update-manager/{id}', [ManagerController::class, 'updateManager'])->name('manager.update-manager');
    });
});

Route::group(['prefix' => 'role'], function () {
    Route::get('index', [RoleController::class, 'showAllRoles'])->name('manager.dashboard')->middleware('manager:read_role');
});

Route::group(['prefix' => 'applicant'], function () {
    // đăng nhập applicant
    Route::get('login', [AuthApplicantController::class, 'showLoginApplicantForm'])->name('applicant.show-login-form');
    Route::post('login', [AuthApplicantController::class, 'loginApplicant'])->name('applicant.login');

    //đăng ký applicant
    Route::get('register', [AuthApplicantController::class, 'showRegisterApplicantForm'])->name('applicant.show-register-form');
    Route::post('register', [AuthApplicantController::class, 'registerApplicant'])->name('applicant.register');
});

Route::group(['prefix' => 'employer'], function () {
    // đăng nhập với employer-người tuyển dụng
    Route::get('login', [AuthEmployerController::class, 'showLoginEmployerForm'])->name('employer.show-login-form');
    Route::post('login', [AuthEmployerController::class, 'loginEmployer'])->name('employer.login');

    // đăng ký employer-người tuyển dụng
    Route::get('register', [AuthEmployerController::class, 'showRegisterEmployerForm'])->name('employer.show-register-form');
    Route::post('register', [AuthEmployerController::class, 'registerEmployer'])->name('employer.register');
});

Route::group(['prefix' => 'post'], function () {
    // hiển thị danh sách bài đăng

    // tạo mới bài đăng tuyển dụng
    Route::get('create_post', [PostController::class, 'showCreatePostForm'])->name('employer.show-create-post-form');
    Route::post('create_post', [PostController::class, 'createPost'])->name('employer.create-post');

    //cập nhật bài đăng tuyển dụng
    Route::get('update_post/{id}', [PostController::class, 'showUpdatePostForm'])->name('employer.show-update-post-form');
    Route::post('update_post/{id}', [PostController::class, 'updatePost'])->name('employer.update-post');

    //xóa bài đăng tuyển dụng
    Route::post('delete_post/{id}', [PostController::class, 'deletePost'])->name('employer.delete-post');
});
