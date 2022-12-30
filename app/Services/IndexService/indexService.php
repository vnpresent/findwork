<?php

namespace App\Services\IndexService;

use App\Models\Post;
use App\Repositories\City\CityRepositoryInterface;
use App\Repositories\Level\LevelRepositoryInterface;
use App\Repositories\Manager\ManagerRepositoryInterface;
use App\Repositories\Post\PostRepositoryInterface;

class indexService
{
    protected $postRepository;
    protected $cityRepository;
    protected $levelRepository;

    public function __construct(PostRepositoryInterface $postRepository, CityRepositoryInterface $cityRepository, LevelRepositoryInterface $levelRepository)
    {
        $this->postRepository = $postRepository;
        $this->cityRepository = $cityRepository;
        $this->levelRepository = $levelRepository;
    }

    public function index()
    {
        $pinnedPosts = $this->postRepository->getPinnedPost();
        $newest_posts = $this->postRepository->getLatestPosts();
        $cities = $this->cityRepository->getAllCitíes();
        $levels = $this->levelRepository->getAllLevels();
        return view('index', ['pinnedPosts' => $pinnedPosts, 'newest_posts' => $newest_posts, 'cities' => $cities, 'levels' => $levels]);
    }

    public function showSearchResults()
    {
//        auth('')
    }

    public function search()
    {

    }
}
