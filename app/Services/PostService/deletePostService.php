<?php

namespace App\Services\PostService;

use App\Interfaces\PostRepositoryInterface;
use App\Traits\CheckExistTrait;

class deletePostService
{
    use CheckExistTrait;

    protected $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function deletePost($id)
    {
        try {
            $post = $this->postRepository->getPost($id);
            if ($this->checkExistsPost($post) !== true) {
                return $this->checkExistsPost($post);
            }

            $result = $this->postRepository->deletePost($id);
            if ($result) {
                return redirect()->back()->with(['success' => 'Đã xóa post thành công thành công']);
            } else {
                return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
            }
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
        }
    }
}
