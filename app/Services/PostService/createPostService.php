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

class createPostService
{
    use CheckExistTrait;

    protected $validateInputPostService;
    protected $skillRepository;
    protected $postRepository;
    protected $workRepository;
    protected $levelRepository;
    protected $experienceRepository;
    protected $degreeRepository;
    protected $workingFormRepository;
    protected $cityRepository;

    public function __construct(validateInputPostService $validateInputPostService, SkillRepositoryInterface $skillRepository, PostRepositoryInterface $postRepository, WorkRepositoryInterface $workRepository, LevelRepositoryInterface $levelRepository, ExperienceRepositoryInterface $experienceRepository, DegreeRepositoryInterface $degreeRepository, WorkingFormRepositoryInterface $workingFormRepository, CityRepositoryInterface $cityRepository)
    {
        $this->validateInputPostService = $validateInputPostService;
        $this->skillRepository = $skillRepository;
        $this->postRepository = $postRepository;
        $this->workRepository = $workRepository;
        $this->levelRepository = $levelRepository;
        $this->experienceRepository = $experienceRepository;
        $this->degreeRepository = $degreeRepository;
        $this->workingFormRepository = $workingFormRepository;
        $this->cityRepository = $cityRepository;
    }

    // trả về form tao mới post
    public function showCreatePostForm()
    {
        try {
            $skills = $this->skillRepository->getAllSkills();
            $works = $this->workRepository->getAllWorks();
            $levels = $this->levelRepository->getAllLevels();
            $experiences = $this->experienceRepository->getAllExperiences();
            $degrees = $this->degreeRepository->getAllDegrees();
            $workingForms = $this->workingFormRepository->getAllWorkingForms();
            $cities = $this->cityRepository->getAllCitíes();
            return view('post.create_post', ['skills' => $skills, 'works' => $works, 'levels' => $levels, 'experiences' => $experiences, 'degrees' => $degrees, 'workingForms' => $workingForms, 'cities' => $cities]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
        }
    }

    // xử lý tạo mới post
    public function createPost($title, $work, $level, $experience, $skills, $degree, $workingForm, $sex, $city, $address, $minSalary, $maxSalary, $numberApplicants, $description, $benefit, $endDate)
    {
        try {
            // validate các thông tin employer gửi lên,nếu thất bại,quay trở lại kèm lỗi
            $validate = $this->validateInputPostService->validateInputCreatePost($title, $work, $level, $experience, $skills, $degree, $workingForm, $sex, $city, $address, $minSalary, $maxSalary, $numberApplicants, $description, $benefit, $endDate);
            if ($validate !== true) {
                return $validate;
            }
            //thành công gọi repository tạo mới,check kết quả trả về sau đó back lại
            $employerId = auth('employer')->user()->id;
            $post = $this->postRepository->createPost($employerId, $title, $work, $level, $experience, $skills, $degree, $workingForm, $sex, $city, $address, $minSalary, $maxSalary, $numberApplicants, $description, $benefit, $endDate);
            if ($this->checkExistsPost($post) === true) {
                return redirect()->back()->with(['success' => 'Đã tạo post mới thành công thành công']);
            } else {
                return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
            }
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
        }
    }
}
