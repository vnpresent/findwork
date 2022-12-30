<?php

namespace App\Services\PostService;

use App\Repositories\Post\PostRepositoryInterface;
use App\Traits\CheckExistTrait;

class confirmPostService
{
    use CheckExistTrait;

    protected $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function confirmPost($id)
    {
//        try {
            $post = $this->postRepository->getPost($id);
            if ($this->postRepository->confirmPost($id)) {
                return redirect()->route('manager.show-all-posts-form');
            } else {
                return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau,vui lòng thử lại sau'])->withInput();
            }
//        } catch (\Exception $e) {
//            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau,vui lòng thử lại sau'])->withInput();
//        }
    }
}
