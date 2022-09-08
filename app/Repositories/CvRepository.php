<?php

namespace App\Repositories;


use App\Interfaces\CvRepositoryInterface;
use App\Models\Cv;
use Illuminate\Support\Facades\DB;

class CvRepository implements CvRepositoryInterface
{
    public function getAllCvs()
    {
        return Cv::all()->toArray();
    }

    public function getApplicantCvs($applicantId)
    {
        return DB::table('cvs')->where('applicant_id', '=', $applicantId)->get()->toArray();
    }

    public function createCv($applicantId)
    {
//        return Cv::create([
//            'applicant_id' => $applicantId,
//        ])->toArray();
    }

    public function getCv($id)
    {
        return Cv::find($id)->toArray();
    }

    public function updateCv($id)
    {
        $data = [];
        return Cv::find($id)->update($data);
    }

    public function deleteCv($id)
    {
        return Cv::delete($id);
    }
}
