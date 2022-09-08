<?php

namespace App\Services\ValidateInputServices;

use Illuminate\Support\Facades\Validator;

class validateInputManagerService
{
    public function validateInputCreateManager($name, $email, $password, $role)
    {
        $data = [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'role' => $role,
        ];
        $validate = Validator::make($data, [
            'name' => 'required|string',
            'email' => 'required|email|unique:managers,email',
            'password' => 'required|string',
            'role' => 'required|array',
            'role[]' => 'required|exists:roles,id',
        ], [
            'name.required' => 'Tên không được để trống',
            'name.string' => 'Tên phải là chuỗi',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã được sử dụng',
            'password.required' => 'Password không được để trống',
            'password.string' => 'Password phải là chuỗi',
            'role.required' => 'Quyền của quản lý không được để trống',
            'role.array' => 'Quyền của quản lý phải là 1 mảng',
            'role[].required' => 'Quyền của quản lý không được để trống',
            'role[].array' => 'Quyền của quản lý không tồn tại',
        ]);
        if ($validate->fails()) {
            return $validate->errors()->first();
        } else {
            return true;
        }
    }

    public function validateInputUpdateManager($name, $email, $password, $role)
    {

    }
}
