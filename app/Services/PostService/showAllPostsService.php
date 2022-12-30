<?php

namespace App\Services\PostService;

use App\Repositories\Post\PostRepositoryInterface;
use App\Traits\GetStatusTrait;

class showAllPostsService
{
    use GetStatusTrait;
    protected $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function showAllPostsForm()
    {
//        try {
            $posts = $this->postRepository->getAllPosts();
            return view('post.show_all_posts', ['posts' => $posts]);
//        } catch (\Exception $e) {
//            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
//        }
    }
}
