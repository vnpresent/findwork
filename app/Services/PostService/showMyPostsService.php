<?php

namespace App\Services\PostService;

use App\Repositories\Post\PostRepositoryInterface;

class showMyPostsService
{
    protected $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function showMyPostsForm()
    {
//        try {
            $employerId = auth('employer')->user()->id;
            $posts = $this->postRepository->getPostsOfEmpolyer($employerId);
            return view('post.show_my_posts', ['posts' => $posts]);
//        } catch (\Exception $e) {
//            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
//        }
    }
}
