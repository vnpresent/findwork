<?php

namespace App\Services\PostService;

use App\Interfaces\PostRepositoryInterface;
use App\Traits\CheckExistTrait;

class showPostService
{
    use CheckExistTrait;

    protected $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function showPostForm($id)
    {
        try {
            // gọi repo lấy post với id từ người dùng,kiếm tra tồn tại post,nếu không tồn tại,back lại kèm lỗi không tồn tại post
            $post = $this->postRepository->getPost($id);
            if ($this->checkExistsPost($post) !== true) {
                return $this->checkExistsPost($post);
            }
            // nếu tồn tại post,trả về view kèm bản ghi post vừa lấy
            return view('post.show_post', ['post' => $post]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
        }
    }
}
