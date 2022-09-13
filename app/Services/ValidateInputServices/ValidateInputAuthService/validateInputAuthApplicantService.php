<?php

namespace App\Services\ValidateInputServices\ValidateInputAuthService;

use Illuminate\Support\Facades\Validator;

class validateInputAuthApplicantService
{
    public function validateInputLoginApplicant($email, $password, $remember)
    {
        $data = [
            'email' => $email,
            'password' => $password,
            'remember' => $remember,
        ];
        $validate = Validator::make($data, [
            'email' => 'required|email',
            'password' => 'required|string',
            'remember' => 'required|boolean',
        ], [
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Password không được để trống',
            'password.string' => 'Password phải là chuỗi',
            'remember.required' => 'Remember không được để trống',
            'remember.boolean' => 'Remember phải là true false',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->with(['error' => $validate->errors()->first()])->withInput();
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
            return redirect()->back()->with(['error' => $validate->errors()->first()])->withInput();
        } else {
            return true;
        }
    }
}
