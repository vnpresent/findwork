<?php

namespace App\Services\EmployerService;

use App\Repositories\Employer\EmployerRepositoryInterface;
use App\Repositories\Post\PostRepositoryInterface;
use App\Traits\CheckExistTrait;

class showEmployerService
{
    use CheckExistTrait;

    protected $employerRepository;
    protected $postRepository;

    public function __construct(EmployerRepositoryInterface $employerRepository, PostRepositoryInterface $postRepository)
    {
        $this->employerRepository = $employerRepository;
        $this->postRepository = $postRepository;
    }

    public function showEmployerForm($id)
    {
        try {
            $employer = $this->employerRepository->getEmployer($id);
            if ($this->checkExistsEmployer($employer) !== true) {
                return $this->checkExistsEmployer($employer);
            }
            $posts = $this->postRepository->getPostsOfEmpolyer($employer['id']);
            return view('employer.show_employer', ['employer' => $employer, 'posts' => $posts]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
        }
    }
}
