<?php

namespace App\Services\PostService;

use App\Repositories\Post\PostRepositoryInterface;
use App\Traits\CheckExistTrait;

class cancelPostService
{
    use CheckExistTrait;

    protected $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function cancelPost($id, $note)
    {
        try {
            $post = $this->postRepository->getPost($id);

            if ($this->postRepository->cancelPost($id, $note)) {
                return redirect()->route('manager.show-all-posts-form')->with(['success' => 'Đã hủy bài đăng tuyển dụng'])->withInput();
            } else {
                return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau,vui lòng thử lại sau'])->withInput();
            }
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau,vui lòng thử lại sau'])->withInput();
        }
    }
}
