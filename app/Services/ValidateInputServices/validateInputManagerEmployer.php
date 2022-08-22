<?php

namespace App\Services\ValidateInputServices;


use Illuminate\Support\Facades\Validator;

class validateInputManagerEmployer
{
    public function validateLoginEmployer($email,$password)
    {
        $data = [
            'email'=>$email,
            'password'=>$password,
        ];
        $validator = Validator::make($data,[
            'email'=>'required|email',
            'password'=>'required|string',
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
