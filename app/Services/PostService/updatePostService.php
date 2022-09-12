<?php

namespace App\Services\PostService;

use App\Interfaces\PostRepositoryInterface;
use App\Services\ValidateInputServices\validateInputPostService;
use App\Traits\CheckExistTrait;

class updatePostService
{
    use CheckExistTrait;

    protected $validateInputPostService;
    protected $postRepository;

    public function __construct(validateInputPostService $validateInputPostService, PostRepositoryInterface $postRepository)
    {
        $this->validateInputPostService = $validateInputPostService;
        $this->postRepository = $postRepository;
    }

    public function showUpdatePostForm($id)
    {
        try {
            $post = $this->postRepository->getPost($id);
            if ($this->checkExistsPost($post) !== true) {
                return $this->checkExistsPost($post);
            }
            return view('post.update_post', ['post' => $post]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau,vui lòng thử lại sau'])->withInput();
        }
    }

    public function updatePost($id, $title, $description, $numberApplicants, $minSalary, $maxSalary, $startDate, $endDate)
    {
        try {
            // validate các thông tin employer gửi lên,nếu thất bại,quay trở lại kèm lỗi
            $validate = $this->validateInputPostService->validateInputUpdatePost($title, $description, $numberApplicants, $minSalary, $maxSalary, $startDate, $endDate);
            if ($validate !== true) {
                return $validate;
            }
            $post = $this->postRepository->getPost($id);
            if ($this->checkExistsPost($post) !== true) {
                return $this->checkExistsPost($post);
            }
            //thành công gọi repository cập nhật,check kết quả trả về sau đó back lại
            $update = $this->postRepository->updatePost($id, $title, $description, $numberApplicants, $minSalary, $maxSalary, $startDate, $endDate);
            if ($update) {
                return redirect()->back()->with(['success' => 'Đã tạo post mới thành công thành công']);
            } else {
                return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau,vui lòng thử lại sau'])->withInput();
            }
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau,vui lòng thử lại sau'])->withInput();
        }
    }
}
