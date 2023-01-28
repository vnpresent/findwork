<?php

namespace App\Services\PostService;

use App\Repositories\City\CityRepositoryInterface;
use App\Repositories\Degree\DegreeRepositoryInterface;
use App\Repositories\Experience\ExperienceRepositoryInterface;
use App\Repositories\Level\LevelRepositoryInterface;
use App\Repositories\Post\PostRepositoryInterface;
use App\Repositories\Skill\SkillRepositoryInterface;
use App\Repositories\Work\WorkRepositoryInterface;
use App\Repositories\WorkingForm\WorkingFormRepositoryInterface;
use App\Services\ValidateInputServices\validateInputPostService;
use App\Traits\CheckExistTrait;

class updatePostService
{
    use CheckExistTrait;

    protected $validateInputPostService;
    protected $postRepository;
    protected $skillRepository;
    protected $workRepository;
    protected $levelRepository;
    protected $experienceRepository;
    protected $degreeRepository;
    protected $workingFormRepository;
    protected $cityRepository;

    public function __construct(validateInputPostService $validateInputPostService, PostRepositoryInterface $postRepository, SkillRepositoryInterface $skillRepository, WorkRepositoryInterface $workRepository, LevelRepositoryInterface $levelRepository, ExperienceRepositoryInterface $experienceRepository, DegreeRepositoryInterface $degreeRepository, WorkingFormRepositoryInterface $workingFormRepository, CityRepositoryInterface $cityRepository)
    {
        $this->validateInputPostService = $validateInputPostService;
        $this->postRepository = $postRepository;
        $this->skillRepository = $skillRepository;
        $this->workRepository = $workRepository;
        $this->levelRepository = $levelRepository;
        $this->experienceRepository = $experienceRepository;
        $this->degreeRepository = $degreeRepository;
        $this->workingFormRepository = $workingFormRepository;
        $this->cityRepository = $cityRepository;
    }

    public function showUpdatePostForm($id)
    {
//        try {
        $post = $this->postRepository->getPost($id);
        $skills = $this->skillRepository->getAllSkills();
        $works = $this->workRepository->getAllWorks();
        $levels = $this->levelRepository->getAllLevels();
        $experiences = $this->experienceRepository->getAllExperiences();
        $degrees = $this->degreeRepository->getAllDegrees();
        $working_forms = $this->workingFormRepository->getAllWorkingForms();
        $cities = $this->cityRepository->getAllCitíes();
        if ($this->checkExistsPost($post) !== true) {
            return $this->checkExistsPost($post);
        }
        $post = (array)$post[0];
        if ($post['employer_id'] != auth('employer')->user()->id) {
            return redirect()->back()->with(['error' => 'Không có quyền'])->withInput();
        }
        return view('post.update_post', ['post' => $post, 'skills' => $skills, 'works' => $works, 'levels' => $levels, 'experiences' => $experiences, 'degrees' => $degrees, 'working_forms' => $working_forms, 'cities' => $cities]);
//        } catch (\Exception $e) {
//            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau,vui lòng thử lại sau'])->withInput();
//        }
    }

    public function updatePost($id, $title, $work, $level, $experience, $skills, $degree, $workingForm, $sex, $city, $address, $minSalary, $maxSalary, $numberApplicants, $description, $benefit, $endDate)
    {
//        try {
        // validate các thông tin employer gửi lên,nếu thất bại,quay trở lại kèm lỗi
        $validate = $this->validateInputPostService->validateInputUpdatePost($id, $title, $work, $level, $experience, $skills, $degree, $workingForm, $sex, $city, $address, $minSalary, $maxSalary, $numberApplicants, $description, $benefit, $endDate);
        if ($validate !== true) {
            return $validate;
        }
        $post = $this->postRepository->getPost($id);
        if ($this->checkExistsPost($post) !== true) {
            return $this->checkExistsPost($post);
        }
        $post = (array)$post[0];
        if ($post['employer_id'] != auth('employer')->user()->id) {
            return redirect()->back()->with(['error' => 'Không có quyền'])->withInput();
        }
        //thành công gọi repository cập nhật,check kết quả trả về sau đó back lại
        $result = $this->postRepository->updatePost($id, $title, $work, $level, $experience, $skills, $degree, $workingForm, $sex, $city, $address, $minSalary, $maxSalary, $numberApplicants, $description, $benefit, $endDate);
        if ($result) {
            return redirect()->back()->with(['success' => 'Đã cập nhật post thành công']);
        } else {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau,vui lòng thử lại sau'])->withInput();
        }
//        } catch (\Exception $e) {
//            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau,vui lòng thử lại sau'])->withInput();
//        }
    }
}
