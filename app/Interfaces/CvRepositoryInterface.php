<?php

namespace App\Interfaces;

interface CvRepositoryInterface
{
    public function getAllCvs();

    public function getApplicantCvs($applicantId);

    public function createCv($applicantId);

    public function getCv($id);

    public function updateCv($id);

    public function deleteCv($id);
}
