<?php

namespace App\Services;

use App\Models\Manager;
use App\Services\ValidateInputServices\Auth\validateInputAuthManagerService;
use App\Services\ValidateInputServices\validateInputManagerService;

class managerService
{
    protected $validateInputAuthManagerService;
    protected $validateInputManagerService;

    public function __construct(validateInputAuthManagerService $validateInputAuthManagerService, validateInputManagerService $validateInputManagerService)
    {
        $this->validateInputAuthManagerService = $validateInputAuthManagerService;
        $this->validateInputManagerService = $validateInputManagerService;
    }

    public function showAllManagers()
    {
        return view('manager.all_manager');
    }

    public function showCreateManageForm()
    {
        return view('manager.create_manager');
    }

    public function createManage($name, $email, $password, $role)
    {
        try {
            // validate name,email,password người dùng gửi lên,nếu thất bại back lại kèm lỗi
            $validate = $this->validateInputAuthManagerService->validateInputCreateManager($name, $email, $password, $role);
            if ($validate !== true) {
                return redirect()->back()->with(['error' => $validate])->withInput();
            }
            // nếu thành công tạo mới manager ,back lại kèm thông báo tạo tài khoản thành công
            Manager::create([
                'name' => $name,
                'email' => $email,
                'password' => bcrypt($password),
            ]);
            return redirect()->back()->with(['success' => 'Đã tạo tài khoản quản lý thành công']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra'])->withInput();
        }
    }

    public function getManagerById($id)
    {
//        try {
//            $validate = $this->validateInputManagerService->validateIdManager($id);
//            if ($validate !== true) {
//                return [
//                    'status'=>false,
//                    'data' => $validate
//                ];
//            }
//            return [
//                'status'=>true,
//                'data' => Manager::find($id),
//            ];
//        }
//        catch (\Exception $e){
//            return [
//                'status'=>false,
//                'data' => 'Thất bại,có lỗi sảy ra'
//            ];
//        }
    }

    public function showUpdateManagerForm($id)
    {
//        $manager = $this->getManagerById($id);
//        if ($manager['status']===true)
//        {
//            return view('manager.update_manager',['manager'=>$manager['data']]);
//        }
//        else
//        {
//            return redirect()->back()->with(['error'=>$manager['data']]);
//        }
    }

    public function updateManager($id, $name, $roles)
    {
//        try {
//
//        }
//        catch (\Exception $e){
//
//        }
    }
}
