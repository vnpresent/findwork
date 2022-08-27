<?php

namespace App\Services\ValidateInputServices;

use Illuminate\Support\Facades\Validator;

class validateInputManagerService
{
    public function validateLoginManager($email, $password)
    {
        $data = [
            'email' => $email,
            'password' => $password,
        ];
        $validator = Validator::make($data, [
            'email' => 'required|email',
            'password' => 'required|string',
        ], [
            'email.required' => 'Email không được để trống',
            'email.email' => 'Phải nhập vào Email',
            'password.required' => 'Password không được để trống',
            'password.string' => 'Password phải là chuỗi',
        ]);
        if ($validator->fails()) {
            return $validator->errors()->first();
        } else {
            return true;
        }
    }

    public function validateCreateManager($name, $email, $password)
    {
        $data = [
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ];
        $validate = Validator::make($data, [
            'name' => 'required|string',
            'email' => 'required|email|unique:managers',
            'password' => 'required|string',
        ], [
            'name.required' => 'Tên không được để trống',
            'name.string' => 'Tên phải là chuỗi',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Phải nhập vào Email',
            'email.unique' => 'Email đã có người sử dụng',
            'password.required' => 'Password không được để trống',
            'password.string' => 'Password phải là chuỗi',
        ]);
        if ($validate->fails()) {
            return $validate->errors()->first();
        } else {
            return true;
        }
    }

    public function validateIdManager($id)
    {
        $data = [
            'id' => $id,
        ];
        $validator = Validator::make($data, [
            'id' => 'required|integer|exists:managers,id',
        ], [
            'id.required' => 'Id không được trống',
            'id.integer' => 'Id phải là số',
            'id.exists' => 'Id không tồn tại',
        ]);
        if ($validator->fails()) {
            return $validator->errors()->first();
        } else {
            return true;
        }
    }

    public function validateUpdateManager($id, $name, $email)
    {

    }
}
