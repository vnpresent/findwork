<?php

namespace App\Services\PostService;

use App\Repositories\Post\PostRepositoryInterface;
use App\Traits\CheckExistTrait;
use Illuminate\Support\Facades\Gate;

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
            // gọi repo lấy post,kiểm tra tồn tại của post,nếu post không tồn tại,back lại kèm lỗi
            $post = $this->postRepository->getPost($id);
            if ($this->checkExistsPost($post) !== true) {
                return $this->checkExistsPost($post);
            }
            if (Gate::allows('delete-post', $post)) {
                if ($this->postRepository->deletePost($id)) {
                    return redirect()->back()->with(['success' => 'Đã xóa post thành công thành công']);
                } else {
                    return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
                }
            } else {
                return redirect()->back()->with(['error' => 'Không có quyền'])->withInput();
            }
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
        }
    }
}
