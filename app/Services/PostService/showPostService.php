<?php

namespace App\Services\PostService;

use App\Repositories\Cv\CvRepositoryInterface;
use App\Repositories\Employer\EmployerRepositoryInterface;
use App\Repositories\Post\PostRepositoryInterface;
use App\Traits\CheckExistTrait;

class showPostService
{
    use CheckExistTrait;

    protected $postRepository;
    protected $cvRepository;

    public function __construct(PostRepositoryInterface $postRepository, CvRepositoryInterface $cvRepository, EmployerRepositoryInterface $employerRepository)
    {
        $this->postRepository = $postRepository;
        $this->cvRepository = $cvRepository;
        $this->employerRepository = $employerRepository;
    }

    public function showPostForm($id)
    {
//        try {
        // gọi repo lấy post với id từ người dùng,kiếm tra tồn tại post,nếu không tồn tại,back lại kèm lỗi không tồn tại post
        $post = $this->postRepository->getPost($id);
        if ($this->checkExistsPost($post) !== true) {
            return $this->checkExistsPost($post);
        }
        $post = (array)$post[0];
        $employer = $this->employerRepository->getEmployer($post['employer_id']);
//        dd($employer);
        if (auth('applicant')->user()) {
            $applicant_id = auth('applicant')->user()->id;
            $cvsOfPost = $this->cvRepository->getApplicantCvsOfPost($applicant_id, $id);
            $cvs = $this->cvRepository->getApplicantCvs($applicant_id);
            $cvsOfPostId = array_column($cvsOfPost, 'id');
        } else {
            $cvs = [];
            $cvsOfPostId = [];
        }
        // nếu tồn tại post,trả về view kèm bản ghi post vừa lấy
        return view('post.show_post', ['post' => $post, 'cvsOfPostId' => $cvsOfPostId, 'cvs' => $cvs, 'employer' => $employer]);
//        } catch (\Exception $e) {
//            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
//        }
    }
}
