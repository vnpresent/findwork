<?php

namespace App\Services\ValidateInputServices;

use Illuminate\Support\Facades\Validator;

class validateInputManagerService
{
    private $response = [
        'id.required' => 'Id lỗi',
        'id.integer' => 'Id lỗi',
        'name.required' => 'Tên không được để trống',
        'name.string' => 'Tên phải là chuỗi',
        'email.required' => 'Email không được để trống',
        'email.email' => 'Email không đúng định dạng',
        'email.unique' => 'Email đã được sử dụng',
        'password.string' => 'Password phải là chuỗi',
        'roles.required' => 'Quyền của quản lý không được để trống',
        'roles.array' => 'Quyền của quản lý phải là 1 mảng',
        'roles[].required' => 'Quyền của quản lý không được để trống',
        'roles[].array' => 'Quyền của quản lý không tồn tại',
    ];

    public function validateInputCreateManager($name, $email, $password, $roles)
    {
        $data = [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'roles' => $roles,
        ];
        $validate = Validator::make($data, [
            'name' => 'required|string',
            'email' => 'required|email|unique:managers,email',
            'password' => 'required|string',
            'roles' => 'nullable|array',
            'roles[].*' => 'required|exists:roles,id',
        ], $this->response);
        if ($validate->fails()) {
            return redirect()->back()->with(['error' => $validate->errors()->first()])->withInput();
        } else {
            return true;
        }
    }

    public function validateInputUpdateManager($id, $name, $roles)
    {
        $data = [
            'id' => $id,
            'name' => $name,
            'roles' => $roles,
        ];
        $validate = Validator::make($data, [
            'id' => 'required|integer',
            'name' => 'required|string',
            'roles' => 'nullable|array',
            'roles[].*' => 'required|exists:roles,id',
        ], $this->response);
        if ($validate->fails()) {
            return redirect()->back()->with(['error' => $validate->errors()->first()])->withInput();
        } else {
            return true;
        }
    }
}
