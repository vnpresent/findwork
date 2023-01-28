<?php

namespace App\Services\ValidateInputServices;

use Illuminate\Support\Facades\Validator;

class validateInputPostService
{
    private $response = [
        'id.required' => 'Lỗi id bài đăng',
        'id.integer' => 'Lỗi id bài đăng',
        'title.required' => 'Tiêu đề không được để trống',
        'title.string' => 'Tiêu đề phải là chuỗi',
        'work.required' => 'Ngành nghề không được để trống',
        'work.integer' => 'Ngành nghề không được để trống',
        'level.array' => 'Kĩ năng đang chọn lỗi',
        'level.integer' => 'Cấp bậc chọn lỗi',
        'experience.required' => 'Kinh nghiệm không được để trống',
        'experience.integer' => 'Kinh nghiệm chọn lỗi',
        'skills.required' => 'Kinh nghiệm không được để trống',
        'degree.required' => 'Bằng cáp không được để trống',
        'degree.integer' => 'Bằng cấp chọn lỗi',
        'workingForm.required' => 'Hình thức làm việc không được để trống',
        'workingForm.integer' => 'Hình thức làm việc chọn lỗi',
        'sex.required' => 'Giới tính không được để trống',
        'sex.integer' => 'Giới tính chọn lỗi',
        'sex.in' => 'Giới tínhp chọn lỗi',
        'city.required' => 'Tỉnh/thành phố không được để trống',
        'city.integer' => 'Tỉnh/thành phố chọn lỗi',
        'address.required' => 'Địa chỉ không được để trống',
        'address.string' => 'Địa chỉ phải là chuỗi',
        'minSalary.required' => 'Lương tối thiểu không được để trống',
        'minSalary.integer' => 'Lương tối thiểu phải là số',
        'maxSalary.required' => 'Lương tối đa không được để trống',
        'maxSalary.integer' => 'Lương tối đa phải là số',
        'numberApplicants.required' => 'Số lượng cần tuyển không được để trống',
        'numberApplicants.integer' => 'Số lượng cần tuyển phải là số',
        'description.required' => 'Mô tả không được để trống',
        'description.string' => 'Mô tả phải là chuỗi ký tự',
        'benefit.required' => 'Quyền lợi không được để trống',
        'benefit.string' => 'Quyền lợi phải là chuỗi ký tự',
        'endDate.required' => 'Ngày kết thúc không được để trống',
        'endDate.date' => 'Hạn nộp phải có định dạng ngày tháng năm',
        'endDate.after' => 'Hạn nộp phải sau ngày hôm nay',
    ];

    public function validateInputCreatePost($title, $work, $level, $experience, $skills, $degree, $workingForm, $sex, $city, $address, $minSalary, $maxSalary, $numberApplicants, $description, $benefit, $endDate)
    {
        $data = [
            'title' => $title,
            'work' => $work,
            'level' => $level,
            'experience' => $experience,
            'skills' => $skills,
            'degree' => $degree,
            'workingForm' => $workingForm,
            'sex' => $sex,
            'city' => $city,
            'address' => $address,
            'minSalary' => $minSalary,
            'maxSalary' => $maxSalary,
            'numberApplicants' => $numberApplicants,
            'description' => $description,
            'benefit' => $benefit,
            'endDate' => $endDate,
        ];
        $validate = Validator::make($data, [
            'title' => 'required|string',
            'work' => 'required|integer',
            'level' => 'required|integer',
            'experience' => 'required|integer',
            'skills' => 'nullable|array',
            'skills.*' => 'nullable|string',
            'degree' => 'required|integer',
            'workingForm' => 'required|integer',
            'sex' => 'required|integer|in:0,1,2',
            'city' => 'required|integer',
            'address' => 'required|string',
            'minSalary' => 'required|integer',
            'maxSalary' => 'required|integer',
            'numberApplicants' => 'required|integer',
            'description' => 'required|string',
            'benefit' => 'required|string',
            'endDate' => 'required|date|after:today',
        ], $this->response);
        if ($validate->fails()) {
            return redirect()->back()->with(['error' => $validate->errors()->first()])->withInput();
        } else {
            return true;
        }
    }

    public function validateInputUpdatePost($id, $title, $work, $level, $experience, $skills, $degree, $workingForm, $sex, $city, $address, $minSalary, $maxSalary, $numberApplicants, $description, $benefit, $endDate)
    {
        $data = [
            'id' => $id,
            'title' => $title,
            'work' => $work,
            'level' => $level,
            'experience' => $experience,
            'skills' => $skills,
            'degree' => $degree,
            'workingForm' => $workingForm,
            'sex' => $sex,
            'city' => $city,
            'address' => $address,
            'minSalary' => $minSalary,
            'maxSalary' => $maxSalary,
            'numberApplicants' => $numberApplicants,
            'description' => $description,
            'benefit' => $benefit,
            'endDate' => $endDate,
        ];
        $validate = Validator::make($data, [
            'id' => 'required|integer',
            'title' => 'required|string',
            'work' => 'required|integer',
            'level' => 'required|integer',
            'experience' => 'required|integer',
            'skills' => 'nullable|array',
            'skills.*' => 'nullable|string',
            'degree' => 'required|integer',
            'workingForm' => 'required|integer',
            'sex' => 'required|integer|in:0,1,2',
            'city' => 'required|integer',
            'address' => 'required|string',
            'minSalary' => 'required|integer',
            'maxSalary' => 'required|integer',
            'numberApplicants' => 'required|integer',
            'description' => 'required|string',
            'benefit' => 'required|string',
            'endDate' => 'required|date|after:today',
        ], $this->response);
        if ($validate->fails()) {
            return redirect()->back()->with(['error' => $validate->errors()->first()])->withInput();
        } else {
            return true;
        }
    }
}
