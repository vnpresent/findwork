<?php

namespace App\Services\ValidateInputServices;

use Illuminate\Support\Facades\Validator;

class validateInputPostService
{
    public function validateCreatePost($title,$description,$number_applicants,$min_salary,$max_salary,$start_date,$end_date)
    {
        $data = [
            'title'=>$title,
            'description'=>$description,
            'number_of_applications'=>$number_applicants,
            'min_salary'=>$min_salary,
            'max_salary'=>$max_salary,
            'start_date'=>$start_date,
            'end_date'=>$end_date,
        ];
        $validate = Validator::make($data,[
            'title'=>'required|string',
            'description'=>'required|string',
            'number_of_applications'=>'required|integer|min:1',
            'min_salary'=>'required|integer|min:0',
            'max_salary'=>'required|integer|min:0',
            'start_date'=>'required|date',
            'end_date'=>'required|date',
        ],[
            'title.rerequired'=>'Tiêu đề không được để trống',
            'title.string'=>'Tiêu đề phải là chuỗi ký tự',
            'description.rerequired'=>'Mô tả không được để trống',
            'description.string'=>'Mô tả phải là chuỗi ký tự',
            'number_of_applications.rerequired'=>'Số lượng tuyển dụng không được để trống',
            'number_of_applications.integer'=>'Số lượng tuyển dụng phải là số',
            'number_of_applications.min'=>'Số lượng tuyển dụng phải lớn hơn 0',
            'min_salary.rerequired'=>'Lương khởi điểm không được để trống',
            'min_salary.integer'=>'Lương khởi điểm phải là số',
            'min_salary.min'=>'Lương khởi điểm phải lớn hơn hoặc bằng 0',
            'max_salary.rerequired'=>'Lương cao nhất không được để trống',
            'max_salary.integer'=>'Lương cao nhất phải là số',
            'max_salary.min'=>'Lương cao nhất phải lớn hơn hoặc bằng 0',
            'start_date.rerequired'=>'Ngày bắt đầu tuyển không được để trống',
            'start_date.integer'=>'Ngày bắt đầu tuyển phải là định dạng ngày',
            'end_date.rerequired'=>'Ngày kết thúc tuyển không được để trống',
            'end_date.integer'=>'Ngày kết thúc tuyển phải là định dạng ngày',
        ]);
        if (!$validate->fails()) {
            return true;
        }else{
            return $validate->errors()->first();
        }
    }
}
