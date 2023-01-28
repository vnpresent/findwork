<?php

namespace App\Services\ValidateInputServices;

use Illuminate\Support\Facades\Validator;

class validateInputCvService
{
    private $response = [
        'id.required' => 'Id lỗi',
        'id.integer' => 'Id lỗi',
        'name.required' => 'Tên CV không được để trống',
        'name.string' => 'Tên CV không được để trống',
        'profile.required' => 'Thông tin cá nhân lỗi',
        'profile.array' => 'Thông tin cá nhân lỗi',
        'profile.name.required' => 'Tên không được để trống',
        'profile.name.string' => 'Tên không được để trống',
        'profile.birthday.date' => 'Ngày sinh lỗi',
    ];

    public function validateInputCreateCv($name, $position, $profile, $objective, $skills, $work_experience, $education, $activities, $certifications)
    {
        $data = [
            'name' => $name,
            'position' => $position,
            'profile' => $profile,
            'objective' => $objective,
            'skills' => $skills,
            'work_experience' => $work_experience,
            'education' => $education,
            'activities' => $activities,
            'certifications' => $certifications,
        ];
        $validate = Validator::make($data, [
            'name' => 'required|string',
            'position' => 'required|string',
            'profile' => 'required|array',
            'profile.name' => 'required|string',
            'profile.birthday' => 'nullable|date',
        ], $this->response);
        if ($validate->fails()) {
            return redirect()->back()->with(['error' => $validate->errors()->first()])->withInput();
        } else {
            return true;
        }
    }

    public function validateInputUpdateCV($id, $name, $position, $profile, $objective, $skills, $work_experience, $education, $activities, $certifications)
    {
        $data = [
            'id' => $id,
            'name' => $name,
            'position' => $position,
            'profile' => $profile,
            'objective' => $objective,
            'skills' => $skills,
            'work_experience' => $work_experience,
            'education' => $education,
            'activities' => $activities,
            'certifications' => $certifications,
        ];
        $validate = Validator::make($data, [
            'id' => 'required|integer',
            'name' => 'required|string',
            'position' => 'required|string',
            'profile' => 'required|array',
            'profile.name' => 'required|string',
            'profile.birthday' => 'nullable|date',
        ], $this->response);
        if ($validate->fails()) {
            return redirect()->back()->with(['error' => $validate->errors()->first()])->withInput();
        } else {
            return true;
        }
    }

    public function validateInputDownloadCv($id)
    {
//        $data = [
//            'id' => $id,
//        ];
//        $validate = Validator::make($data, [
//            'id' => 'required|integer',
//        ], [
//            'id.required' => 'Id không được để trống',
//            'id.integer' => 'Id phải là số',
//        ]);
//        if ($validate->fails()) {
//            return redirect()->back()->with(['error' => $validate->errors()->first()])->withInput();
//        }
//        if (auth('employer')->user() != null) {
//
//            $applies_id = auth('employer')->user()->getCvs;
//            return true;
//        }
//        if (auth('manager')->user() != null && auth('manager')->user()->hasPermission('download_cv')) {
//            return true;
//        }
    }
}
