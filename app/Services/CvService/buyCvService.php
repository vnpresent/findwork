<?php

namespace App\Services\CvService;

use App\Repositories\Cv\CvRepositoryInterface;
use App\Repositories\Employer\EmployerRepositoryInterface;
use App\Repositories\Post\PostRepositoryInterface;
use App\Repositories\Setting\SettingRepositoryInterface;
use App\Services\ValidateInputServices\validateInputPostService;
use App\Traits\CheckExistTrait;

class buyCvService
{
    use CheckExistTrait;

    protected $validateInputPostService;
    protected $cvRepository;
    protected $postRepository;
    protected $settingRepository;
    protected $employerRepository;

    public function __construct(validateInputPostService $validateInputPostService, CvRepositoryInterface $cvRepository, PostRepositoryInterface $postRepository, SettingRepositoryInterface $settingRepository, EmployerRepositoryInterface $employerRepository)
    {
        $this->validateInputPostService = $validateInputPostService;
        $this->cvRepository = $cvRepository;
        $this->postRepository = $postRepository;
        $this->settingRepository = $settingRepository;
        $this->employerRepository = $employerRepository;
    }

    public function buyCv($id)
    {
//        try {
        $purchasedcvs = array_column($this->cvRepository->getPurchasedCvs(auth('employer')->user()->id), 'id');
        $cv = $this->cvRepository->getCv($id);
        if (!in_array($cv['id'], $purchasedcvs)) {
            $price = $this->settingRepository->getCVPrice();
            if (auth('employer')->user()->balance >= $price) {
                if ($this->employerRepository->buyCv(auth('employer')->user()->id, $id)) {
                    return redirect()->back()->with(['success' => 'Đã mua cv thành công']);
                } else {
                    return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau,vui lòng thử lại sau'])->withInput();
                }
            } else {
                return redirect()->back()->with(['error' => 'Thất bại,số dư không đủ'])->withInput();
            }
        } else {
            return redirect()->back()->with(['error' => 'Thất bại,cv này đã được mua'])->withInput();
        }
//        } catch (\Exception $e) {
//            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau,vui lòng thử lại sau'])->withInput();
//        }
    }
}
