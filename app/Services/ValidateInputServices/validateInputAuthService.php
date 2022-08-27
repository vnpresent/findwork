<?php

namespace App\Services\ValidateInputServices;

use Illuminate\Support\Facades\Validator;

class validateInputAuthService
{
    public function validateInputAuthEmployer($email, $password)
    {
        $data = [
            'email' => $email,
            'password' => $password,
        ];
        $validate = Validator::make($data, [
            'email' => 'required|email|exists:employers,email',
            'password' => 'required|string'
        ], [
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'email.exists' => 'Email không tồn tại',
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
