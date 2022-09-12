<?php

namespace App\Services\PostService;

use App\Interfaces\PostRepositoryInterface;
use App\Services\ValidateInputServices\validateInputPostService;

class postService
{
    protected $validateInputPostService;
    protected $postRepository;

    public function __construct(validateInputPostService $validateInputPostService, PostRepositoryInterface $postRepository)
    {
        $this->validateInputPostService = $validateInputPostService;
        $this->postRepository = $postRepository;
    }

    public function showAllPostForm()
    {

    }

    // trả về form tao mới post
    public function showCreatePostForm()
    {
        return view('post.create_post');
    }

    // xử lý tạo mới post
    public function createPost($title, $description, $numberApplicants, $minSalary, $maxSalary, $startDate, $endDate)
    {
        try {
            // validate các thông tin employer gửi lên,nếu thất bại,quay trở lại kèm lỗi
            $validate = $this->validateInputPostService->validateInputCreatePost($title, $description, $numberApplicants, $minSalary, $maxSalary, $startDate, $endDate);
            if ($validate !== true) {
                return redirect()->back()->with(['error' => $validate])->withInput();
            }
            //thành công gọi repository tạo mới,check kết quả trả về sau đó back lại
            $post = $this->postRepository->createPost($title, $description, $numberApplicants, $minSalary, $maxSalary, $startDate, $endDate);
            if (count($post) > 0) {
                return redirect()->back()->with(['success' => 'Đã tạo post mới thành công thành công']);
            } else {
                return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
            }
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
        }
    }

    public function showUpdatePostForm($id)
    {
        try {
            $post = $this->postRepository->getPost($id);
            if (count($post)) {
                return view('post.update_post', ['post' => $post]);
            } else {
                return redirect()->back()->with(['error' => 'Không tồn tại post'])->withInput();
            }
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
                return redirect()->back()->with(['error' => $validate])->withInput();
            }
            $post = $this->postRepository->getPost($id);
            if (count($post) > 0) {
                $update = $this->postRepository->updatePost($id, $title, $description, $numberApplicants, $minSalary, $maxSalary, $startDate, $endDate);
                if ($update) {
                    return redirect()->back()->with(['success' => 'Đã tạo post mới thành công thành công']);
                } else {
                    return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau,vui lòng thử lại sau'])->withInput();
                }
            } else {
                return redirect()->back()->with(['error' => 'Không tồn tại post'])->withInput();
            }
            //thành công gọi repository cập nhật,check kết quả trả về sau đó back lại
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau,vui lòng thử lại sau'])->withInput();
        }
    }

    public function deletePost($id)
    {
        try {
            $validate = $this->validateInputPostService->validateInputPostId($id);
            if ($validate !== true) {
                return redirect()->back()->with(['error' => $validate])->withInput();
            }
            $post = $this->postRepository->deletePost($id);
            if ($post) {
                return redirect()->back()->with(['success' => 'Đã xóa post thành công thành công']);
            } else {
                return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
            }
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
        }
    }
}
