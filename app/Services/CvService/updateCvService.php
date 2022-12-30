<?php

namespace App\Services\CvService;

use App\Repositories\Cv\CvRepositoryInterface;
use App\Repositories\Skill\SkillRepositoryInterface;
use App\Traits\CheckExistTrait;

class updateCvService
{
    use CheckExistTrait;

    protected $cvRepository;
    protected $skillRepository;

    public function __construct(CvRepositoryInterface $cvRepository, SkillRepositoryInterface $skillRepository)
    {
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
            return view('cv.update_cv', ['cv' => $cv, 'skills' => $skills]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
        }
    }

    public function updateCv($id, $name, $position, $profile, $objective, $skills, $work_experience, $education, $activities, $certifications)
    {
//        try {
        $cv = $this->cvRepository->getCv($id);
        if ($this->checkExistsCv($cv) !== true) {
            return $this->checkExistsCv($cv);
        }
        $cv = $this->cvRepository->updateCv($id, $name, $position, $profile, $objective, $skills, $work_experience, $education, $activities, $certifications);
        return redirect()->back()->with(['success' => 'Cập nhật cv thành công'])->withInput();
//        } catch (\Exception $e) {
//            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
//        }
    }
}
