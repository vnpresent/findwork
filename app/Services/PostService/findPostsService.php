<?php

namespace App\Services\PostService;

use App\Repositories\City\CityRepositoryInterface;
use App\Repositories\Level\LevelRepositoryInterface;
use App\Repositories\Post\PostRepositoryInterface;

class findPostsService
{
    protected $levelRepository;
    protected $cityRepository;
    protected $postRepository;

    public function __construct(LevelRepositoryInterface $levelRepository, CityRepositoryInterface $cityRepository, PostRepositoryInterface $postRepository)
    {
        $this->levelRepository = $levelRepository;
        $this->cityRepository = $cityRepository;
        $this->postRepository = $postRepository;
    }

    public function showFindPostsForm($search, $level, $city, $page)
    {
//        try {
        $levels = $this->levelRepository->getAllLevels();
        $cities = $this->cityRepository->getAllCitíes();
        $posts = $this->postRepository->findPosts($search, $level, $city);
        return view('post.find_posts', ['levels' => $levels, 'cities' => $cities, 'posts' => $posts, 'search' => $search, 'level_find' => $level, 'city_find' => $city, 'page' => $page]);
//        } catch (\Exception $e) {
//            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
//        }
    }
}
