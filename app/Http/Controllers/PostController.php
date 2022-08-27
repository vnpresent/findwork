<?php

namespace App\Http\Controllers;

use App\Services\postService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct(postService $postService)
    {
        $this->postService = $postService;
    }

    public function showCreatePostForm()
    {
        return $this->postService->showCreatePostForm();
    }
    public function createPost(Request $request)
    {
        return $this->postService->createPost($request->title,$request->description,$request->number_applicants,$request->min_salary,$request->max_salary,$request->start_date,$request->end_date);
    }
}
