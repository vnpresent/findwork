<?php

namespace App\Services\CvService;

use App\Repositories\Cv\CvRepositoryInterface;
use App\Repositories\Skill\SkillRepositoryInterface;
use App\Services\TrainService\suggestService;
use App\Traits\CheckExistTrait;

class suggestCvService
{
    use CheckExistTrait;

    protected $cvRepository;
    protected $suggestService;

    public function __construct(CvRepositoryInterface $cvRepository, suggestService $suggestService)
    {
        $this->cvRepository = $cvRepository;
        $this->suggestService = $suggestService;
    }

    public function showSuggestCvForm($id)
    {
        $cv = $this->cvRepository->getCv($id);
        if ($this->checkExistsCv($cv) !== true) {
            return $this->checkExistsCv($cv);
        }
        if ($cv['applicant_id'] != auth('applicant')->user()->id) {
            return redirect()->back()->with(['error' => 'Bạn không có quyền'])->withInput();
        }
        $skill_ids = array_column($cv['skills'], 'id');
        $posts = $this->suggestService->suggest($skill_ids);
        return view('post.suggest_post', ['posts' => $posts]);
//        try {
//            return view('cv.create_cv', ['skills' => $skills]);
//        } catch (\Exception $e) {
//            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
//        }
    }

}
