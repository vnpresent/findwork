<?php

namespace App\Services\ValidateInputServices;

use Illuminate\Support\Facades\Validator;

class validateInputPostService
{
    public function validateCreatePost($title, $description, $number_applicants, $min_salary, $max_salary, $start_date, $end_date)
    {
        $data = [
            'title' => $title,
            'description' => $description,
            'number_applicants' => $number_applicants,
            'min_salary' => $min_salary,
            'max_salary' => $max_salary,
            'start_date' => $start_date,
            'end_date' => $end_date,
        ];
        $validate = Validator::make($data, [
            'title' => 'required|string',
            'description' => 'required|string',
            'number_applicants' => 'required|integer|min:1',
            'min_salary' => 'required|integer|min:0',
            'max_salary' => 'required|integer|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ], [
            'title.required' => 'Tiêu đề không được để trống',
            'title.string' => 'Tiêu đề phải là chuỗi ký tự',
            'description.required' => 'Mô tả không được để trống',
            'description.string' => 'Mô tả phải là chuỗi ký tự',
            'number_applicants.required' => 'Số lượng tuyển không được để trống',
            'number_applicants.integer' => 'Số lượng tuyển phải là số',
            'number_applicants.min' => 'Số lượng tuyển phải lớn hơn 0',
            'min_salary.required' => 'Lương tối thiểu không được để trống',
            'min_salary.integer' => 'Lương tối thiểu phải là số',
            'min_salary.min' => 'Lương tối thiểu phải lớn hơn hoặc bằng 0',
            'max_salary.required' => 'Lương tối đa không được để trống',
            'max_salary.integer' => 'Lương tối đa phải là số',
            'max_salary.min' => 'Lương tối đa phải lớn hơn hoặc bằng 0',
            'start_date.required' => 'Ngày bắt đầu tuyển không được để trống',
            'start_date.integer' => 'Ngày bắt đầu tuyển phải là định dạng ngày',
            'end_date.required' => 'Ngày kết thúc tuyển không được để trống',
            'end_date.integer' => 'Ngày kết thúc tuyển phải là định dạng ngày',
            'end_date.after' => 'Ngày kết thúc tuyển phải sau ngày bắt đầu',
        ]);
        if ($validate->fails()) {
            return $validate->errors()->first();
        } else {
            return true;
        }
    }

    public function validateInputPostId($id)
    {
        $data = [
            'id' => $id,
        ];
        $validate = Validator::make($data, [
            'id' => 'required|integer|exists:posts,id'
        ], [
            'id.required' => 'Id không được trống',
            'id.integer' => 'Id phải là số',
            'id.exists' => 'Id không tồn tại',
        ]);
        if ($validate->fails()) {
            return $validate->errors()->first();
        } else {
            return true;
        }
    }
}
