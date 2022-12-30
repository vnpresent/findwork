<?php

namespace App\Services\CvService;

use App\Repositories\City\CityRepositoryInterface;
use App\Repositories\Cv\CvRepositoryInterface;
use App\Repositories\Setting\SettingRepositoryInterface;
use App\Traits\CheckExistTrait;

class findCvService
{
    use CheckExistTrait;

    protected $cityRepository;
    protected $cvRepository;
    protected $settingRepository;

    public function __construct(CityRepositoryInterface $cityRepository, CvRepositoryInterface $cvRepository, SettingRepositoryInterface $settingRepository)
    {
        $this->cityRepository = $cityRepository;
        $this->cvRepository = $cvRepository;
        $this->settingRepository = $settingRepository;
    }

    public function findCv($search, $city, $page)
    {
//        try {
//        $cv = $this->cvRepository->getCv($id);
//        if ($this->checkExistsCv($cv) !== true) {
//            return $this->checkExistsCv($cv);
//        }
//            dd($cv);
        $cities = $this->cityRepository->getAllCitíes();
        $cvs = $this->cvRepository->findCv($search, $city);
        $price = $this->settingRepository->getCVPrice();
        return view('cv.find_cv', ['cities' => $cities, 'cvs' => $cvs])->with(['search' => $search, 'city_find' => $city, 'price' => $price, 'page' => $page]);
//            $result = $this->cvRepository->deleteCv($id);
//            if ($result) {
//                return redirect()->back()->with(['success' => 'Đã xóa CV thành công thành công']);
//            } else {
//                return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
//            }
//        } catch (\Exception $e) {
//            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
//        }
    }
}
