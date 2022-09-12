<?php

namespace App\Interfaces;

interface PostRepositoryInterface
{
    public function getAllPosts();

    public function getPostsOfEmpolyer($employerId);

    public function getPinnedPost();

    public function searchPosts($q);

    public function applyPost($id, $cvId);

    public function unapplyPost($id, $cvId);

    public function createPost($title, $description, $numberApplicants, $minSalary, $maxSalary, $startDate, $endDate);

    public function getPost($id);

    public function updatePost($id, $title, $description, $numberApplicants, $minSalary, $maxSalary, $startDate, $endDate);

    public function deletePost($id);
}
