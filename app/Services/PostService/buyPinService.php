<?php

namespace App\Services\PostService;

use App\Repositories\Cv\CvRepositoryInterface;
use App\Repositories\Post\PostRepositoryInterface;
use App\Repositories\Setting\SettingRepositoryInterface;
use App\Services\ValidateInputServices\validateInputPostService;
use App\Traits\CheckExistTrait;

class buyPinService
{
    use CheckExistTrait;

    protected $validateInputPostService;
    protected $cvRepository;
    protected $postRepository;
    protected $settingRepository;

    public function __construct(validateInputPostService $validateInputPostService, CvRepositoryInterface $cvRepository, PostRepositoryInterface $postRepository, SettingRepositoryInterface $settingRepository)
    {
        $this->validateInputPostService = $validateInputPostService;
        $this->cvRepository = $cvRepository;
        $this->postRepository = $postRepository;
        $this->settingRepository = $settingRepository;
    }

    public function buyPin($id)
    {
//        try {
        // gọi repo lấy post bằng id ,sau đó kiểm tra tồn tại post,nếu không tồn tại,back về kèm thông báo lỗi không tồn tại post
        $post = $this->postRepository->getPost($id);
        if ($this->checkExistsPost($post) !== true) {
            return $this->checkExistsPost($post);
        }
        $post = (array)$post[0];
        if (!$post['is_pinned']) {
            $price = $this->settingRepository->getPinPrice();
            if (auth('employer')->user()->balance >= $price) {
                if ($this->postRepository->buyPin($id, auth('employer')->user()->id, $price)) {
                    return redirect()->back()->with(['success' => 'Đã mua ghim thành công']);
                } else {
                    return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau,vui lòng thử lại sau'])->withInput();
                }
            } else {
                return redirect()->back()->with(['error' => 'Thất bại,số dư không đủ'])->withInput();
            }
        } else {
            return redirect()->back()->with(['error' => 'Thất bại,bài đăng này đã được mua ghim'])->withInput();
        }
//        } catch (\Exception $e) {
//            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau,vui lòng thử lại sau'])->withInput();
//        }
    }
}
