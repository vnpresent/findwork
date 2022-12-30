<?php

use App\Http\Controllers\Auth\AuthApplicantController;
use App\Http\Controllers\Auth\AuthEmployerController;
use App\Http\Controllers\Auth\AuthManagerController;
use App\Http\Controllers\CvController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
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


//
// applicant - ứng viên
//
Route::group(['prefix' => 'applicant'], function () {
    // đăng nhập applicant
//    Route::get('login', [AuthApplicantController::class, 'showLoginApplicantForm'])->name('applicant.login-form');

    Route::get('login', [AuthApplicantController::class, 'showLoginApplicantForm'])->name('applicant.show-login-form');
    Route::post('login', [AuthApplicantController::class, 'loginApplicant'])->name('applicant.login');

    //đăng ký applicant
    Route::get('register', [AuthApplicantController::class, 'showRegisterApplicantForm'])->name('applicant.show-register-form');
    Route::post('register', [AuthApplicantController::class, 'registerApplicant'])->name('applicant.register');

    Route::group(['middleware' => 'applicant'], function () {
        Route::get('profile', [AuthApplicantController::class, 'showUpdateProfileForm'])->name('applicant.show-update-profile-form');
        Route::post('profile', [AuthApplicantController::class, 'updateProfile'])->name('applicant.update-profile');
        Route::get('logout', [AuthApplicantController::class, 'logout'])->name('applicant.logout')->middleware('applicant');
    });
});
//middleware applicant - ứng viên
Route::group(['middleware' => 'applicant'], function () {
    //
    //cv
    //
    // danh  sách cv
    Route::get('my-cvs', [CvController::class, 'showMyCvsForm'])->name('applicant.my-cvs-form');
    // tạo cv
    Route::get('create-cv', [CvController::class, 'showCreateCvForm'])->name('applicant.show-create-cv-form');
    Route::post('create-cv', [CvController::class, 'createCv'])->name('applicant.create-cv');
    // cập nhật cv
    Route::get('update-cv/{id}', [CvController::class, 'showUpdateCvForm'])->name('applicant.show-update-cv-form');
    Route::post('update-cv/{id}', [CvController::class, 'updateCv'])->name('applicant.update-cv');
    // xem gợi ý của cv
    Route::get('suggest-cv/{id}', [CvController::class, 'showSuggestCvForm'])->name('applicant.show-suggest-cv-form');
    // bài đăng đã apply
    Route::get('applied_posts', [PostController::class, 'showAppliedPostsForm'])->name('applicant.show-applied-posts-form');
    //
    //post
    //
    Route::post('apply-post/{id}', [PostController::class, 'applyPost'])->name('applicant.apply-post');
    Route::post('unapply-post/{id}', [PostController::class, 'unapplyPost'])->name('applicant.unapply-post');
});


//
// employer - nhà tuyển dụng
//
Route::group(['prefix' => 'employer'], function () {
    // đăng nhập với employer-người tuyển dụng
    Route::get('login', [AuthEmployerController::class, 'showLoginEmployerForm'])->name('employer.show-login-form');
    Route::post('login', [AuthEmployerController::class, 'loginEmployer'])->name('employer.login');

    // đăng ký employer-người tuyển dụng
    Route::get('register', [AuthEmployerController::class, 'showRegisterEmployerForm'])->name('employer.show-register-form');
    Route::post('register', [AuthEmployerController::class, 'registerEmployer'])->name('employer.register');

    Route::group(['middleware' => 'employer'], function () {
        Route::get('logout', [AuthEmployerController::class, 'logout'])->name('employer.logout');

        Route::get('profile', [AuthEmployerController::class, 'showUpdateProfileForm'])->name('employer.show-update-profile-form');
        Route::post('profile', [AuthEmployerController::class, 'updateProfile'])->name('employer.update-profile');
        Route::post('update-avatar', [AuthEmployerController::class, 'updateAvatar'])->name('employer.update-avatar');

        Route::get('change_password', [AuthEmployerController::class, 'showChangePasswordForm'])->name('employer.show-change-password-form');
        Route::post('change_password', [AuthEmployerController::class, 'changePassword'])->name('employer.change-password');
        // dasboard người tuyển dụng
        Route::get('dashboard', [DashboardController::class, 'dashboardEmployer'])->name('employer.dashboard');
    });
});
Route::group(['middleware' => 'employer'], function () {
    //
    //post - bài đăng tuyển dụng
    //
    // danh sách tất cả bài đăng
    Route::get('my-posts', [PostController::class, 'showMyPostsForm'])->name('employer.show-my-posts-form');
    // tạo mới bài đăng tuyển dụng
    Route::get('create-post', [PostController::class, 'showCreatePostForm'])->name('employer.show-create-post-form');
    Route::post('create-post', [PostController::class, 'createPost'])->name('employer.create-post');
    // cập nhật bài đăng tuyển dụng
    Route::get('update-post/{id}', [PostController::class, 'showUpdatePostForm'])->name('employer.show-update-post-form');
    Route::post('update-post/{id}', [PostController::class, 'updatePost'])->name('employer.update-post');
    // mua ghim bài đăng
    Route::post('buy-pin', [PostController::class, 'buyPin'])->name('employer.buy-pin');

    // xem danh sách cv đã ứng tuyển vào bài đăng
    Route::get('show-apply-cvs/{id}', [CvController::class, 'showApplyCvsForm'])->name('employer.show-apply-cvs-form');
    // xem danh sách cv đã mua
    Route::get('show-purchased-cvs', [CvController::class, 'showPurchasedCvsForm'])->name('employer.show-purchased-cvs-form');
    // mua cv
    Route::post('buy-cv', [CvController::class, 'buyCv'])->name('employer.buy-cv');

    // tạo phiếu nạp tiền
    Route::get('create-payment', [PaymentController::class, 'showCreatePaymentForm'])->name('employer.show-create-payment-form');
    Route::post('create-payment', [PaymentController::class, 'createPayment'])->name('employer.create-payment');
    // xem danh sách phiếu nạp tiền
    Route::get('my-payments', [PaymentController::class, 'showMyPaymentsForm'])->name('employer.show-my-payments-form');
    // xem phiếu nạp tiền
    Route::get('show-payment/{id}', [PaymentController::class, 'showPaymentForm'])->name('employer.show-payment-form');
    // xử lý nạp tiền
    Route::get('vnpay-payment', [PaymentController::class, 'VNPayPayment'])->name('employer.vnpay-payment');


    //
    //cv
    //
    //tìm kiếm cv
    Route::get('find-cv', [CvController::class, 'showFindCvForm'])->name('employer.show-find-cv-form');
});

// download cv
Route::get('download-cv/{id}', [CvController::class, 'downloadCv'])->name('applicant.download-cv');
// xem cv
Route::get('show-cv/{id}', [CvController::class, 'showCvForm'])->name('applicant.show-cv-form');

//Route::get('/',function (){
//    return 'ok';
//});
// quản lý tài khoản manager
Route::group(['prefix' => 'manager'], function () {
    // đămg nhập của mangager
    Route::get('login', [AuthManagerController::class, 'showLoginForm'])->name('manager.show-login-form');
    Route::post('login', [AuthManagerController::class, 'login'])->name('manager.login');

    // màn dashboard
    Route::get('dashboard', [DashboardController::class, 'dashboardManager'])->name('manager.dashboard')->middleware('permission:read_manager');

    Route::get('logout', [AuthManagerController::class, 'showLoginForm'])->name('manager.logout');
});

// xóa bài đăng
Route::post('delete-post', [PostController::class, 'deletePost'])->name('delete-post');


//

Route::group(['middleware' => 'manager'], function () {
    //
    // Post
    //
    // danh sách bài đăng
    Route::get('all-posts', [PostController::class, 'showAllPostsForm'])->name('manager.show-all-posts-form');
    // xác nhận ,hủy bài đăng
    Route::post('confirm-post', [PostController::class, 'confirmPost'])->name('manager.confirm-post');
    Route::post('cancel-post', [PostController::class, 'cancelPost'])->name('manager.cancel-post');


    //
    // Quản lý website
    //
    // tất cả người quản lý website
    Route::get('all-managers', [ManagerController::class, 'showAllManagersForm'])->name('manager.show-all-managers-form');
    //
    // Employer
    //
    // tất cả nhà tuyển dụng
    Route::get('all-employers', [EmployerController::class, 'showAllEmployersForm'])->name('manager.show-all-employers-form');
    // xem nhà tuyển dụng
    Route::get('show-employer/{id}', [EmployerController::class, 'showEmployerForm'])->name('manager.show-employer-form');
    // xóa nhà tuyển dụng
    Route::post('delete-employer', [EmployerController::class, 'deleteEmployer'])->name('manager.delete-employer');

    // tất cả CV
    Route::get('all-cvs', [CvController::class, 'showAllCvsForm'])->name('manager.show-all-cvs-form');


    //
    // Payment
    //
    // tất cả phiếu nạp
    Route::get('all-payments', [PaymentController::class, 'showAllPaymentsForm'])->name('manager.show-all-payments-form');
    // xác nhận phiếu nạp
    Route::post('confirm-payment', [PaymentController::class, 'confirmPayment'])->name('manager.confirm-payment');
    // hủy phiếu nạp
    Route::post('cancel-payment', [PaymentController::class, 'cancelPayment'])->name('manager.cancel-payment');
    //

    //
    // Role
    //
    // tất cả vai trò
    Route::get('all-roles', [RoleController::class, 'showAllRolesForm'])->name('manager.show-all-roles-form');
    // tạo vai trò
    Route::get('create-role', [RoleController::class, 'showCreateRoleForm'])->name('manager.show-create-role-form');
    Route::post('create-role', [RoleController::class, 'createRole'])->name('manager.create-role');
    // xem vai trò
    Route::get('show-role/{id}', [RoleController::class, 'showRoleForm'])->name('manager.show-roles-form');
    // cập nhật vai trò
    Route::get('update-role/{id}', [RoleController::class, 'showUpdateRoleForm'])->name('manager.show-update-role-form');
    Route::post('update-role/{id}', [RoleController::class, 'updateRole'])->name('manager.update-role');
    //


    // chức năng tạo tài khoản quản lý mới,bọc kèm middleware kiểm tra quyền tạo mới
    Route::group(['middleware' => 'permission:create_manager'], function () {
        Route::get('create-manager', [ManagerController::class, 'showCreateManagerForm'])->name('manager.show-create-manager-form');
        Route::post('create-manager', [ManagerController::class, 'createManager'])->name('manager.create-manager');
    });

    // chức năng cập nhật thông tin quản lý,bọc bởi middlware kiểm tra quyền cập nhật
    Route::group(['middleware' => 'permission:update_manager'], function () {
        Route::get('update-manager/{id}', [ManagerController::class, 'showUpdateManagerForm'])->name('manager.show-update-manager-form');
        Route::post('update-manager/{id}', [ManagerController::class, 'updateManager'])->name('manager.update-manager');
    });
    // chức năng xóa quản lý
    Route::post('delete-manager', [ManagerController::class, 'deleteManager'])->name('manager.delete-manager');
});

// xóa cv
Route::post('delete-cv', [CvController::class, 'deleteCv'])->name('delete-cv');
// trang index
Route::get('/', [IndexController::class, 'index'])->name('index');
// tìm kiếm bài đăng tuyển dụng
Route::get('find-posts', [PostController::class, 'findPosts'])->name('find-posts');
// xem bài đăng tuyển dụng
Route::get('show-post/{id}', [PostController::class, 'showPostForm'])->name('applicant.show-post-form');
// xem bài đăng mới nhất
Route::get('latest_posts', [PostController::class, 'showLatestPostsForm'])->name('show-latest-posts-form');
