<?php

namespace App\Services\PostService;

use App\Repositories\Cv\CvRepositoryInterface;
use App\Repositories\Post\PostRepositoryInterface;
use App\Services\ValidateInputServices\validateInputPostService;
use App\Traits\CheckExistTrait;

class applyPostService
{
    use CheckExistTrait;

    protected $validateInputPostService;
    protected $cvRepository;
    protected $postRepository;

    public function __construct(validateInputPostService $validateInputPostService, CvRepositoryInterface $cvRepository, PostRepositoryInterface $postRepository)
    {
        $this->validateInputPostService = $validateInputPostService;
        $this->cvRepository = $cvRepository;
        $this->postRepository = $postRepository;
    }

    public function applyPost($id, $cvId)
    {
        try {
            // gọi repo lấy post bằng id ,sau đó kiểm tra tồn tại post,nếu không tồn tại,back về kèm thông báo lỗi không tồn tại post
            $post = $this->postRepository->getPost($id);
            if ($this->checkExistsPost($post) !== true) {
                return $this->checkExistsPost($post);
            }
            // nếu tồn tại,goi repo lấy cv bằng cvid ,kiểm tra sự tồn tại,back về kèm thông báo lỗi không tồn tại cv
            $cv = $this->cvRepository->getCv($cvId);
            if ($this->checkExistsCv($cv) !== true) {
                return $this->checkExistsPost($cv);
            }
            // gọi repo applyPost,kiếm tra kết quả và trả về thông báo tương ứng
            $this->postRepository->applyPost($id, $cvId);
            return redirect()->back()->with(['success' => 'Đã ứng tuyển thành công']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau,vui lòng thử lại sau'])->withInput();
        }
    }
}
