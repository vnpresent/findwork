<?php

namespace App\Services\PostService;

use App\Repositories\Post\PostRepositoryInterface;

class showAppliedPostsService
{
    protected $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function showAppliedPostsForm()
    {
//        try {
        $applicant_id = auth('applicant')->user()->id;
        $posts = $this->postRepository->getPostsOfApplicant($applicant_id);
        return view('post.show_applied_posts', ['posts' => $posts]);
//        } catch (\Exception $e) {
//            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
//        }
    }
}
