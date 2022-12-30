<?php

namespace App\Repositories\Cv;

interface CvRepositoryInterface
{
    public function getAllCvs();

    public function getCvsOfPost($postId);

    public function getCvsOfEmployerPosts($employer_id);


    public function findCv($search, $city);

    public function getApplicantCvsOfPost($applicant_id, $postId);

    public function getApplicantCvs($applicant_Id);

    public function getPurchasedCvs($employer_id);

    public function createCv($applicant_Id, $name, $position, $profile, $objective, $skills, $work_experience, $education, $activities, $certifications);

    public function getCv($id);

    public function updateCv($id, $name, $position, $profile, $objective, $skills, $work_experience, $education, $activities, $certifications);

    public function deleteCv($id);
}
