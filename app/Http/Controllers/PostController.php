<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
//
    }

    public function showCreatePostForm()
    {
//        return $this->postService->showCreatePostForm();
    }

    public function createPost(Request $request)
    {
//        return $this->postService->createPost($request->title, $request->description, $request->number_applicants, $request->min_salary, $request->max_salary, $request->start_date, $request->end_date);
    }

    public function showUpdatePostForm($id)
    {
//        return $this->postService->showUpdatePostForm($id);
    }

    public function updatePost(Request $request)
    {
//        return $this->postService->updatePost($request->id, $request->title, $request->description, $request->number_applicants, $request->min_salary, $request->max_salary, $request->start_date, $request->end_date);
    }

    public function deletePost($id)
    {
//        return $this->postService->deletePost($id);
    }
}
