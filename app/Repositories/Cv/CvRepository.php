<?php

namespace App\Repositories\Cv;


use App\Models\Cv;
use App\Models\Employer;
use App\Repositories\Employer\EmployerRepositoryInterface;
use App\Repositories\Skill\SkillRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CvRepository implements CvRepositoryInterface
{
    protected $skillRepository;
    protected $employerRepository;

    public function __construct(SkillRepositoryInterface $skillRepository, EmployerRepositoryInterface $employerRepository)
    {
        $this->skillRepository = $skillRepository;
        $this->employerRepository = $employerRepository;
    }

    public function getAllCvs()
    {
        return Cv::latest()->get()->toArray();
    }

    public function getCvsOfPost($postId)
    {
        $data = [];
        $list_id = [];
//        $ids = DB::table('cvs')
//            ->whereIn('id', function ($query) use ($postId) {
//                $query->select('cv_id')
//                    ->from('cv_post')
//                    ->where('post_id', '=', $postId);
//            })->select('cvs.id as id')->get()->toArray();
//        foreach ($ids as $id){
//            $list_id[] =$id->id;
//        }
//        $cvs = Cv::whereIn('id',$list_id)->get();
//        foreach ($cvs as $cv) {
////            dd($cv->profile);
//            $data[] = $cv;
//        }
        $cvs = DB::table('cvs')
            ->whereIn('id', function ($query) use ($postId) {
                $query->select('cv_id')
                    ->from('cv_post')
                    ->where('post_id', '=', $postId);
            })->get();
        foreach ($cvs as $cv) {
            $cv = (array)$cv;
            $cv['profile'] = (array)json_decode($cv['profile']);
            $data[] = $cv;
        }
        return $data;
    }

    public function getCvsOfEmployerPosts($employer_id)
    {
        $data = [];
        $cvs = DB::table('posts as tp')
            ->where('tp.employer_id', '=', $employer_id)
            ->join('cv_post as tcp', 'tp.id', '=', 'tcp.post_id')
            ->select('tcp.cv_id as id')
            ->get()->toArray();
        foreach ($cvs as $cv) {
            $cv = (array)$cv;
            $data[] = $cv;
        }
        return $data;
    }

    public function findCv($search, $city)
    {
        $data = [];
//        ->where('position', 'like', '%' . $search . '%')
        $cvs = Cv::where('position', 'like', '%' . $search . '%')->paginate(15)->toArray()['data'];
//        $cvs = Cv::where('position', 'like', '%' . $search . '%')->paginate(5)->toArray()['data'];
        $purchasedcvs = array_column($this->getPurchasedCvs(auth('employer')->user()->id), 'id');
        foreach ($cvs as $cv) {
            $cv['skills'] = $this->skillRepository->getSkillsOfCv($cv['id']);
            if (str_contains($cv['profile']['address'], $city)) {
                if (in_array($cv['id'], $purchasedcvs)) {
                    $cv['purchased'] = true;
                } else {
                    $cv['purchased'] = false;
                }
                $data[] = $cv;
            }
        }
        return $data;
    }

    public function getApplicantCvsOfPost($applicant_id, $postId)
    {
        $data = [];
        $cvs = DB::table('cvs')
            ->where('applicant_id', '=', $applicant_id)
            ->whereIn('id', function ($query) use ($postId) {
                $query->select('cv_id')
                    ->from('cv_post')
                    ->where('post_id', '=', $postId);
            })->get()->toArray();
        foreach ($cvs as $cv) {
            $data[] = (array)$cv;
        }
        return $data;
    }

    public function getApplicantCvs($applicant_Id)
    {
        $data = [];
        $cvs = DB::table('cvs')->where('applicant_id', '=', $applicant_Id)->whereNull('deleted_at')->latest()->get()->toArray();
        foreach ($cvs as $cv) {
            $cv = (array)$cv;
            $cv['profile'] = (array)json_decode($cv['profile']);
            $data[] = $cv;
        }
        return $data;
    }

    public function getPurchasedCvs($employer_id)
    {
//        return auth('employer')->user()->getCvs();
        $data = [];
        $cvs = Employer::find($employer_id)->getCvs->toArray();
        foreach ($cvs as $cv) {
            $cv = (array)$cv;
//            $cv['profile'] = (array)json_decode($cv['profile']);
            $data[] = $cv;
        }
        return $data;
    }

    public function createCv($applicant_Id, $name, $position, $profile, $objective, $skills, $work_experience, $education, $activities, $certifications)
    {
        $cv = Cv::create([
            'applicant_id' => $applicant_Id,
            'name' => $name,
            'position' => $position,
            'profile' => $profile,
            'objective' => $objective,
            'work_experience' => $work_experience,
            'education' => $education,
            'activities' => $activities,
            'certifications' => $certifications,
        ]);
        foreach ($skills as $skill) {
            $id = $this->skillRepository->getIdBySkillName($skill['name']);
            $cv->getSkills()->attach($id, ['description' => $skill['description']]);
        }
        return $cv->toArray();
    }

    public function getCv($id)
    {
        $cv = Cv::find($id);
        if ($cv) {
            $cv = $cv->toArray();
            $cv['skills'] = $this->skillRepository->getSkillsOfCv($id);
        }
        return $cv;
    }

    public function updateCv($id, $name, $position, $profile, $objective, $skills, $work_experience, $education, $activities, $certifications)
    {
        $data = [
            'name' => $name,
            'position' => $position,
            'profile' => $profile,
            'objective' => $objective,
            'work_experience' => $work_experience,
            'education' => $education,
            'activities' => $activities,
            'certifications' => $certifications,
        ];
        $cv = Cv::find($id);
        $data_ids = [];
        foreach ($skills as $skill) {
            $id = $this->skillRepository->getIdBySkillName($skill['name']);
            $data_ids[$id] = ['description' => $skill['description']];
        }
        $cv->getSkills()->sync($data_ids);
        return $cv->update($data);
    }

    public function deleteCv($id)
    {
        return Cv::find($id)->delete();
    }
}
