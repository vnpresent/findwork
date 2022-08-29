<?php

namespace App\Services\ValidateInputServices\Auth;

use Illuminate\Support\Facades\Validator;

class validateInputAuthService
{
    public function validateInputLoginEmployer($email, $password)
    {
        $data = [
            'email' => $email,
            'password' => $password,
        ];
        $validate = Validator::make($data, [
            'email' => 'required|email',
//            |exists:employers,email
            'password' => 'required|string'
        ], [
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
//            'email.exists' => 'Email không tồn tại',
            'password.required' => 'Password không được để trống',
            'password.string' => 'Password phải là chuỗi',
        ]);
        if ($validate->fails()) {
            return $validate->errors()->first();
        } else {
            return true;
        }
    }

    public function validateInputRegisterEmployer($company_name, $email, $password)
    {
        $data = [
            'company_name' => $company_name,
            'email' => $email,
            'password' => $password,
        ];
        $validate = Validator::make($data, [
            'company_name' => 'required|string',
            'email' => 'required|email|unique:employers,email',
            'password' => 'required|string'
        ], [
            'company_name.required' => 'Tên  không được để trống',
            'company_name.string' => 'Tên  phải là chuỗi',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã được sử dụng',
            'password.required' => 'Password không được để trống',
            'password.string' => 'Password phải là chuỗi',
        ]);
        if ($validate->fails()) {
            return $validate->errors()->first();
        } else {
            return true;
        }
    }

    public function validateInputLoginApplicant($email, $password)
    {
        $data = [
            'email' => $email,
            'password' => $password,
        ];
        $validate = Validator::make($data, [
            'email' => 'required|email',
            'password' => 'required|string'
        ], [
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Password không được để trống',
            'password.string' => 'Password phải là chuỗi',
        ]);
        if ($validate->fails()) {
            return $validate->errors()->first();
        } else {
            return true;
        }
    }

    public function validateInputRegisterApplicant($name, $email, $password)
    {
        $data = [
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ];
        $validate = Validator::make($data, [
            'name' => 'required|string',
            'email' => 'required|email|unique:applicants,email',
            'password' => 'required|string'
        ], [
            'name.required' => 'Tên không được để trống',
            'name.string' => 'Tên phải là chuỗi',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Password không được để trống',
            'password.string' => 'Password phải là chuỗi',
        ]);
        if ($validate->fails()) {
            return $validate->errors()->first();
        } else {
            return true;
        }
    }
}
