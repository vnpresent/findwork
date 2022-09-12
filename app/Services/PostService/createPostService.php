<?php

namespace App\Services\PostService;

use App\Interfaces\PostRepositoryInterface;
use App\Services\ValidateInputServices\validateInputPostService;
use App\Traits\CheckExistTrait;

class createPostService
{
    use CheckExistTrait;

    protected $validateInputPostService;
    protected $postRepository;

    public function __construct(validateInputPostService $validateInputPostService, PostRepositoryInterface $postRepository)
    {
        $this->validateInputPostService = $validateInputPostService;
        $this->postRepository = $postRepository;
    }

    // trả về form tao mới post
    public function showCreatePostForm()
    {
        try {
            return view('employer.create_post');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
        }
    }

    // xử lý tạo mới post
    public function createPost($title, $description, $numberApplicants, $minSalary, $maxSalary, $startDate, $endDate)
    {
        try {
            // validate các thông tin employer gửi lên,nếu thất bại,quay trở lại kèm lỗi
            $validate = $this->validateInputPostService->validateInputCreatePost($title, $description, $numberApplicants, $minSalary, $maxSalary, $startDate, $endDate);
            if ($validate !== true) {
                return $validate;
            }
            //thành công gọi repository tạo mới,check kết quả trả về sau đó back lại
            $post = $this->postRepository->createPost($title, $description, $numberApplicants, $minSalary, $maxSalary, $startDate, $endDate);
            if ($this->checkExistsPost($post) === true) {
                return redirect()->back()->with(['success' => 'Đã tạo post mới thành công thành công']);
            } else {
                return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
            }
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
        }
    }
}
