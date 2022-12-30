<?php

namespace App\Repositories\Post;

interface PostRepositoryInterface
{
    public function getAllPosts();

    public function getPostsOfEmpolyer($employerId);

    public function getPostsOfApplicant($applicant_id);

    public function getAllPinnedPost();

    public function getPinnedPost();

    public function getLatestPosts();

    public function searchPosts($laws);

    public function applyPost($id, $cvId);

    public function unapplyPost($id, $cvId);

    public function createPost($employerId, $title, $work, $level, $experience, $skills, $degree, $workingForm, $sex, $city, $address, $minSalary, $maxSalary, $numberApplicants, $description, $benefit, $endDate);

    public function getPost($id);

    public function confirmPost($id);

    public function cancelPost($id, $note);

    public function updatePost($id, $title, $work, $level, $experience, $skills, $degree, $workingForm, $sex, $city, $address, $minSalary, $maxSalary, $numberApplicants, $description, $benefit, $endDate);

    public function deletePost($id);

    public function getPostsByWorkId($work_id);

    public function buyPin($id, $employer_id, $total);

    public function findPosts($search, $level, $city);
}
