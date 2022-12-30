<?php

namespace App\Services\PostService;

use App\Repositories\Post\PostRepositoryInterface;

class showLatestPostsService
{
    protected $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function showLatestPostsForm($page)
    {
        try {
            // gọi repository lấy danh sách post mới nhất và đổ ra view
            $posts = $this->postRepository->getLatestPosts();
            return view('post.show_latest_posts', ['posts' => $posts, 'page' => $page]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
        }
    }
}
