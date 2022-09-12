<?php

namespace App\Services\ValidateInputServices;

use Illuminate\Support\Facades\Validator;

class validateInputManagerService
{
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
            'roles' => 'required|array',
            'roles[]' => 'required|exists:roles,id',
        ], [
            'name.required' => 'Tên không được để trống',
            'name.string' => 'Tên phải là chuỗi',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã được sử dụng',
            'password.required' => 'Password không được để trống',
            'password.string' => 'Password phải là chuỗi',
            'roles.required' => 'Quyền của quản lý không được để trống',
            'roles.array' => 'Quyền của quản lý phải là 1 mảng',
            'roles[].required' => 'Quyền của quản lý không được để trống',
            'roles[].array' => 'Quyền của quản lý không tồn tại',
        ]);
        if ($validate->fails()) {
            redirect()->back()->with(['error' => $validate->errors()->first()])->withInput();
        } else {
            return true;
        }
    }

    public function validateInputUpdateManager($name, $email, $password, $roles)
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
            'password' => 'nullable|string',
            'roles' => 'required|array',
            'roles[]' => 'required|exists:roles,id',
        ], [
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
        ]);
        if ($validate->fails()) {
            redirect()->back()->with(['error' => $validate->errors()->first()])->withInput();
        } else {
            return true;
        }
    }
}
