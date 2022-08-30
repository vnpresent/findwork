<?php

namespace App\Interfaces;

interface PostRepositoryInterface
{
    public function getAllPosts();

    public function getPinnedPost();

    public function searchPosts();

    public function createPost($title, $description, $numberApplicants, $minSalary, $maxSalary, $startDate, $endDate);

    public function getPost($id);

    public function updatePost($id, $title, $description, $numberApplicants, $minSalary, $maxSalary, $startDate, $endDate);

    public function deletePost($id);
}
