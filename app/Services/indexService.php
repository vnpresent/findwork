<?php

namespace App\Services;

use App\Models\Post;

class indexService
{
    public function index()
    {
        $posts = Post::orderBy('id','desc')->get();
        return view('index', ['posts' => $posts]);
    }

    public function showSearchResults()
    {

    }

    public function search()
    {

    }
}
