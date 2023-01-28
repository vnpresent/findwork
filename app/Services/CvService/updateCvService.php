<?php

namespace App\Services\CvService;

use App\Repositories\Cv\CvRepositoryInterface;
use App\Repositories\Skill\SkillRepositoryInterface;
use App\Services\ValidateInputServices\validateInputCvService;
use App\Traits\CheckExistTrait;

class updateCvService
{
    use CheckExistTrait;

    protected $validateInputCvService;
    protected $cvRepository;
    protected $skillRepository;

    public function __construct(validateInputCvService $validateInputCvService, CvRepositoryInterface $cvRepository, SkillRepositoryInterface $skillRepository)
    {
        $this->validateInputCvService = $validateInputCvService;
        $this->cvRepository = $cvRepository;
        $this->skillRepository = $skillRepository;
    }

    public function showUpdateCvForm($id)
    {
        try {
            $cv = $this->cvRepository->getCv($id);
            $skills = $this->skillRepository->getAllSkills();
            $skills = array_column($skills, 'name');
            if ($this->checkExistsCv($cv) !== true) {
                return $this->checkExistsCv($cv);
            }
            if ($cv['applicant_id'] != auth('applicant')->user()->id) {
                return redirect()->back()->with(['error' => 'Bạn không có quyền'])->withInput();
            }
            return view('cv.update_cv', ['cv' => $cv, 'skills' => $skills]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
        }
    }

    public function updateCv($id, $name, $position, $profile, $objective, $skills, $work_experience, $education, $activities, $certifications)
    {
//        try {
        // validate các thông tin employer gửi lên,nếu thất bại,quay trở lại kèm lỗi
        $validate = $this->validateInputCvService->validateInputCreateCv($name, $position, $profile, $objective, $skills, $work_experience, $education, $activities, $certifications);
        if ($validate !== true) {
            return $validate;
        }
        $cv = $this->cvRepository->getCv($id);
        if ($this->checkExistsCv($cv) !== true) {
            return $this->checkExistsCv($cv);
        }
        if ($cv['applicant_id'] != auth('applicant')->user()->id) {
            return redirect()->back()->with(['error' => 'Bạn không có quyền'])->withInput();
        }
        $cv = $this->cvRepository->updateCv($id, $name, $position, $profile, $objective, $skills, $work_experience, $education, $activities, $certifications);
        return redirect()->back()->with(['success' => 'Cập nhật cv thành công'])->withInput();
//        } catch (\Exception $e) {
//            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
//        }
    }
}
