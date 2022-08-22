<?php

namespace App\Services\ValidateInputServices;


use Illuminate\Support\Facades\Validator;

class validateInputUserService
{
    public function validateLoginUser($email,$password)
    {
        $data = [
            'email'=>$email,
            'password'=>$password,
        ];
        $validator = Validator::make($data,[
            'email'=>'required|email',
            'password'=>'required|string',
        ],[
            'email.required'=>'Email không được để trống',
            'email.email'=>'Phải nhập vào Email',
            'password.required'=>'Password không được để trống',
            'password.string'=>'Password phải là chuỗi',
        ]);
        if (!$validator->fails())
        {
            return true;
        }
        else
        {
            return $validator->errors()->first();
        }
    }
}
