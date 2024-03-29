<?php

namespace App\Services\CvService;

use App\Repositories\Cv\CvRepositoryInterface;
use App\Repositories\Skill\SkillRepositoryInterface;
use App\Services\ValidateInputServices\validateInputCvService;
use App\Traits\CheckExistTrait;

class createCvService
{
    use CheckExistTrait;

    protected $skillRepository;
    protected $validateInputCvService;
    protected $cvRepository;

    public function __construct(validateInputCvService $validateInputCvService, SkillRepositoryInterface $skillRepository, CvRepositoryInterface $cvRepository)
    {
        $this->validateInputCvService = $validateInputCvService;
        $this->skillRepository = $skillRepository;
        $this->cvRepository = $cvRepository;
    }

    public function showCreateCvForm()
    {
        try {
            $skills = $this->skillRepository->getAllSkills();
            $skills = array_column($skills, 'name');
            return view('cv.create_cv', ['skills' => $skills]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
        }
    }

    public function createCv($name, $position, $profile, $objective, $skills, $work_experience, $education, $activities, $certifications)
    {
        // validate các thông tin employer gửi lên,nếu thất bại,quay trở lại kèm lỗi
        $validate = $this->validateInputCvService->validateInputCreateCv($name, $position, $profile, $objective, $skills, $work_experience, $education, $activities, $certifications);
        if ($validate !== true) {
            return $validate;
        }
        $applicant_id = auth('applicant')->user()->id;
        $cv = $this->cvRepository->createCv($applicant_id, $name, $position, $profile, $objective, $skills, $work_experience, $education, $activities, $certifications);
        if ($cv) {
            return redirect()->route('applicant.my-cvs-form')->with(['success' => 'Tạo CV Thành Công'])->withInput();
        } else {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
        }
//            if ($cv != null) {

//            }
//        } catch (\Exception $e) {
//            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
//        }
    }
}
