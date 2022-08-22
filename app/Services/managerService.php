<?php

namespace App\Services;

use App\Models\Manager;
use App\Services\ValidateInputServices\validateInputManagerService;

class managerService
{
    protected $validateInputManagerService;

    public function __construct(validateInputManagerService $validateInputManagerService)
    {
        $this->validateInputManagerService = $validateInputManagerService;
    }

    public function dashboard()
    {
        return view('manager.dashboard');
    }

    public function showCreateManageForm()
    {
        return view('manager.create_manager');
    }

    public function createManage($name, $email, $password)
    {
        try {
            $validate = $this->validateInputManagerService->validateCreateManager($name, $email, $password);
            if ($validate !== true) {
                return redirect()->back()->with(['error' => $validate])->withInput();
            }
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
        try {
            $validate = $this->validateInputManagerService->validateIdManager($id);
            if ($validate !== true) {
                return [
                    'status'=>false,
                    'data' => $validate
                ];
            }
            return [
                'status'=>true,
                'data' => Manager::find($id),
            ];
        }
        catch (\Exception $e){
            return [
                'status'=>false,
                'data' => 'Thất bại,có lỗi sảy ra'
            ];
        }
    }

    public function showUpdateManagerForm($id)
    {
        $manager = $this->getManagerById($id);
        if ($manager['status']===true)
        {
            return view('manager.update_manager',['manager'=>$manager['data']]);
        }
        else
        {
            return redirect()->back()->with(['error'=>$manager['data']]);
        }
    }

//    public function updateManager($id,$name)
//    {
//        try {
//
//        }
//        catch (\Exception $e){
//
//        }
//    }
}
