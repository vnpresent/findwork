<?php

namespace App\Repositories;


use App\Interfaces\PostRepositoryInterface;
use App\Models\Post;

class PostRepository implements PostRepositoryInterface
{
    public function getAllPosts()
    {
        return Post::all();
    }

    public function getPinnedPost()
    {
        return Post::all()->where('is_pinned', true);
    }

    public function searchPosts()
    {
        return Post::all()->where('s', '=', '2');
    }

    public function createPost($title, $description, $numberApplicants, $minSalary, $maxSalary, $startDate, $endDate)
    {
        return Post::create([
            'employer_id' => auth('employer')->user()->id,
            'title' => $title,
            'description' => $description,
            'number_applicants' => $numberApplicants,
            'min_salary' => $minSalary,
            'max_salary' => $maxSalary,
            'start_date' => $startDate,
            'end_date' => $endDate,
        ]);
    }

    public function getPost($id)
    {
        return Post::find($id);
    }

    public function updatePost($id, $title, $description, $numberApplicants, $minSalary, $maxSalary, $startDate, $endDate)
    {
        $post = Post::find($id);
        return $post->update([
            'title' => $title,
            'description' => $description,
            'number_applicants' => $numberApplicants,
            'min_salary' => $minSalary,
            'max_salary' => $maxSalary,
            'start_date' => $startDate,
            'end_date' => $endDate,
        ]);
    }

    public function deletePost($id)
    {
        return Post::find($id)->delete();
    }
}
