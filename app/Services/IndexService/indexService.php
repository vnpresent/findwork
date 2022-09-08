<?php

namespace App\Services\IndexService;

use App\Interfaces\ManagerRepositoryInterface;
use App\Models\Post;

class indexService
{
    protected $managerRepository;

    public function __construct(ManagerRepositoryInterface $managerRepository)
    {
        $this->managerRepository = $managerRepository;
    }

    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->get();
        return view('index', ['posts' => $posts]);
    }

    public function showSearchResults()
    {
//        auth('')
    }

    public function search()
    {

    }
}
