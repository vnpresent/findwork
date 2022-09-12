<?php

namespace App\Repositories;


use App\Interfaces\PostRepositoryInterface;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class PostRepository implements PostRepositoryInterface
{
    public function getAllPosts()
    {
        return Post::all()->toArray();
    }

    public function getPostsOfEmpolyer($employerId)
    {
        return DB::table('posts')
            ->where('employer_id', '=', $employerId)
            ->get()
            ->toArray();
    }

    public function getPinnedPost()
    {
        return Post::all()->where('is_pinned', true)->toArray();
    }

    public function searchPosts($q)
    {
        return Post::all()->where('q', '=', $q);
    }

    public function applyPost($id, $cvId)
    {
        return Post::find($id)->getCvs()->attach($cvId);
    }

    public function unapplyPost($id, $cvId)
    {
        return Post::find($id)->getCvs()->detach($cvId);
    }


    public function createPost($title, $description, $numberApplicants, $minSalary, $maxSalary, $startDate, $endDate)
    {
        $data = [
            'employer_id' => auth('employer')->user()->id,
            'title' => $title,
            'description' => $description,
            'number_applicants' => $numberApplicants,
            'min_salary' => $minSalary,
            'max_salary' => $maxSalary,
            'start_date' => $startDate,
            'end_date' => $endDate,
        ];
        return Post::create($data);
    }

    public function getPost($id)
    {
        return Post::find($id)->toArray();
    }

    public function updatePost($id, $title, $description, $numberApplicants, $minSalary, $maxSalary, $startDate, $endDate)
    {
        $data = [
            'title' => $title,
            'description' => $description,
            'number_applicants' => $numberApplicants,
            'min_salary' => $minSalary,
            'max_salary' => $maxSalary,
            'start_date' => $startDate,
            'end_date' => $endDate,
        ];
        $post = Post::find($id);
        return $post->update($data);
    }

    public function deletePost($id)
    {
        return Post::find($id)->delete();
    }
}
