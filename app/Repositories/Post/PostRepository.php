<?php

namespace App\Repositories\Post;


use App\Models\Post;
use App\Repositories\Employer\EmployerRepositoryInterface;
use App\Repositories\Setting\SettingRepositoryInterface;
use App\Repositories\Skill\SkillRepositoryInterface;
use App\Traits\GetStatusTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PostRepository implements PostRepositoryInterface
{
    use GetStatusTrait;

    protected $employerRepository;
    protected $skillRepository;
    protected $settingRepository;

    public function __construct(EmployerRepositoryInterface $employerRepository, SkillRepositoryInterface $skillRepository, SettingRepositoryInterface $settingRepository)
    {
        $this->employerRepository = $employerRepository;
        $this->skillRepository = $skillRepository;
        $this->settingRepository = $settingRepository;
    }

    public function getAllPosts()
    {
        $data = [];
        $posts = DB::table('posts as tp')
            ->join('works as tw', 'tp.work_id', '=', 'tw.id')
            ->join('levels as tl', 'tp.level_id', '=', 'tl.id')
            ->join('experiences as te', 'tp.experience_id', '=', 'te.id')
            ->join('degrees as td', 'tp.degree_id', '=', 'td.id')
            ->join('working_forms as twf', 'tp.working_form_id', '=', 'twf.id')
            ->join('cities as tc', 'tp.city_id', '=', 'tc.id')
            ->select('tp.id as id', 'tp.title as title',
                'tw.name as work', 'tl.name as level',
                'te.name as experience', 'td.name as degree', 'twf.name as workingForm', 'tp.sex as sex', 'tc.name as city',
                'tp.address as address', 'tp.min_salary as minSalary', 'tp.max_salary as maxSalary',
                'tp.number_applicants as numberApplicants',
                'tp.description as description',
                'tp.benefit as benefit',
                'tp.end_date as endDate',
                'tp.is_pinned as isPinned',
                'tp.status as status',
                'tp.note as note',
                'tp.created_at as createdAt',
                'tp.updated_at as updatedAt',
            )
            ->latest()
            ->get()
            ->toArray();
        foreach ($posts as $post) {
            $data[] = (array)$post;
        }
        return $data;
    }

    public function getPostsOfEmpolyer($employerId)
    {
        $data = [];
        $posts = DB::table('posts as tp')
            ->where('employer_id', '=', $employerId)
            ->where('status', '!=', $this->getStatusDelete())
            ->join('works as tw', 'tp.work_id', '=', 'tw.id')
            ->join('levels as tl', 'tp.level_id', '=', 'tl.id')
            ->join('experiences as te', 'tp.experience_id', '=', 'te.id')
            ->join('degrees as td', 'tp.degree_id', '=', 'td.id')
            ->join('working_forms as twf', 'tp.working_form_id', '=', 'twf.id')
            ->join('cities as tc', 'tp.city_id', '=', 'tc.id')
            ->select('tp.id as id', 'tp.title as title',
                'tw.name as work', 'tl.name as level',
                'te.name as experience', 'td.name as degree', 'twf.name as working_form', 'tp.sex as sex', 'tc.name as city',
                'tp.address as address', 'tp.min_salary as min_salary', 'tp.max_salary as max_salary',
                'tp.number_applicants as number_applicants',
                'tp.description as description',
                'tp.benefit as benefit',
                'tp.end_date as end_date',
                'tp.is_pinned as is_pinned',
                'tp.status as status',
                'tp.note as note',
                'tp.created_at as created_at',
                'tp.updated_at as updated_at',
            )
            ->latest()
            ->get()
            ->toArray();
        $avatar = $this->employerRepository->getEmployer($employerId)['avatar'];
        foreach ($posts as $post) {
            $post = (array)$post;
            $post['price'] = $this->settingRepository->getPinPrice();
            $post['status_text'] = $this->getStatusById($post['status']);
            $post['avatar'] = $avatar;
            $data[] = $post;
        }
        return $data;
    }

    public function getPostsOfApplicant($applicant_id)
    {
        $data = [];
        $posts = DB::table('cvs as tc')
            ->where('tc.applicant_id', '=', $applicant_id)
            ->join('cv_post as cpt', 'tc.id', '=', 'cpt.cv_id')
            ->join('posts as tp', 'cpt.post_id', '=', 'tp.id')
            ->where('tp.status', '!=', $this->getStatusDelete())
            ->select(
                'tc.id as cv_id',
                'tc.name as cv_name',
                'tp.id as post_id',
                'tp.title as post_title',
            )
            ->get()
            ->toArray();

        foreach ($posts as $post) {
            $post = (array)$post;
            $data[] = $post;
        }
        return $data;
    }

    public function getAllPinnedPost()
    {
        $data = [];
        $pinnedPosts = DB::table('posts as tp')
            ->where('is_pinned', '=', true)
            ->where('tp.status', '!=', $this->getStatusDelete())
            ->join('works as tw', 'tp.work_id', '=', 'tw.id')
            ->join('levels as tl', 'tp.level_id', '=', 'tl.id')
            ->join('experiences as te', 'tp.experience_id', '=', 'te.id')
            ->join('degrees as td', 'tp.degree_id', '=', 'td.id')
            ->join('working_forms as twf', 'tp.working_form_id', '=', 'twf.id')
            ->join('cities as tc', 'tp.city_id', '=', 'tc.id')
            ->select('tp.id as id',
                'tp.employer_id as employer_id',
                'tp.title as title',
                'tw.name as work',
                'tp.work_id as work_id',
                'tl.name as level',
                'tp.level_id as level_id',
                'te.name as experience',
                'td.name as degree',
                'twf.name as working_form',
                'tp.sex as sex',
                'tc.name as city',
                'tp.address as address',
                'tp.min_salary as min_salary',
                'tp.max_salary as max_salary',
                'tp.number_applicants as number_applicants',
                'tp.description as description',
                'tp.benefit as benefit',
                'tp.end_date as end_date',
                'tp.is_pinned as is_pinned',
                'tp.status as status',
                'tp.note as note',
                'tp.created_at as created_at',
                'tp.updated_at as updated_at',
            )
            ->latest()
            ->get()
            ->toArray();
        foreach ($pinnedPosts as $pinnedPost) {
            $pinnedPost = (array)$pinnedPost;
            $pinnedPost['avatar'] = $this->employerRepository->getEmployer($pinnedPost['employer_id'])['avatar'];
            $data[] = $pinnedPost;
        }
        return $data;
    }

    public function getPinnedPost()
    {
        $data = [];
        $pinnedPosts = DB::table('posts as tp')
            ->where('is_pinned', '=', true)
            ->where('tp.status', '!=', $this->getStatusDelete())
            ->whereDate('end_date', '>=', today()->toDate())
            ->join('works as tw', 'tp.work_id', '=', 'tw.id')
            ->join('levels as tl', 'tp.level_id', '=', 'tl.id')
            ->join('experiences as te', 'tp.experience_id', '=', 'te.id')
            ->join('degrees as td', 'tp.degree_id', '=', 'td.id')
            ->join('working_forms as twf', 'tp.working_form_id', '=', 'twf.id')
            ->join('cities as tc', 'tp.city_id', '=', 'tc.id')
            ->select('tp.id as id',
                'tp.employer_id as employer_id',
                'tp.title as title',
                'tw.name as work',
                'tp.work_id as work_id',
                'tl.name as level',
                'tp.level_id as level_id',
                'te.name as experience',
                'td.name as degree',
                'twf.name as working_form',
                'tp.sex as sex',
                'tc.name as city',
                'tp.address as address',
                'tp.min_salary as min_salary',
                'tp.max_salary as max_salary',
                'tp.number_applicants as number_applicants',
                'tp.description as description',
                'tp.benefit as benefit',
                'tp.end_date as end_date',
                'tp.is_pinned as is_pinned',
                'tp.status as status',
                'tp.note as note',
                'tp.created_at as created_at',
                'tp.updated_at as updated_at',
            )
            ->latest()
            ->get()
            ->toArray();
        foreach ($pinnedPosts as $pinnedPost) {
            $pinnedPost = (array)$pinnedPost;
            $pinnedPost['avatar'] = $this->employerRepository->getEmployer($pinnedPost['employer_id'])['avatar'];
            $data[] = $pinnedPost;
        }
        return $data;
    }

    public function getLatestPosts()
    {
        $data = [];
        $posts = DB::table('posts as tp')
            ->where('tp.status', '=', $this->getStatusConfirm())
            ->join('works as tw', 'tp.work_id', '=', 'tw.id')
            ->join('levels as tl', 'tp.level_id', '=', 'tl.id')
            ->join('experiences as te', 'tp.experience_id', '=', 'te.id')
            ->join('degrees as td', 'tp.degree_id', '=', 'td.id')
            ->join('working_forms as twf', 'tp.working_form_id', '=', 'twf.id')
            ->join('cities as tc', 'tp.city_id', '=', 'tc.id')
            ->select('tp.id as id',
                'tp.employer_id as employer_id',
                'tp.title as title',
                'tw.name as work', 'tl.name as level',
                'te.name as experience', 'td.name as degree', 'twf.name as working_form', 'tp.sex as sex', 'tc.name as city',
                'tp.address as address', 'tp.min_salary as min_salary', 'tp.max_salary as max_salary',
                'tp.number_applicants as number_applicants',
                'tp.description as description',
                'tp.benefit as benefit',
                'tp.end_date as end_date',
                'tp.is_pinned as is_pinned',
                'tp.status as status',
                'tp.note as note',
                'tp.created_at as created_at',
                'tp.updated_at as updated_at',
            )
            ->orderBy('created_at','desc')
            ->paginate(9)
            ->toArray()['data'];
        foreach ($posts as $post) {
            $post = (array)$post;
            $post['avatar'] = $this->employerRepository->getEmployer($post['employer_id'])['avatar'];
            $data[] = $post;
        }
        return $data;
    }

    public function searchPosts($laws)
    {
//        return Post::all()->where(function ($query) use ($laws) {
//            foreach ($laws as $key => $value) {
//                $query->where($key, 'like', $value);
//            }
//        })->get()->toArray();
    }

    public function applyPost($id, $cvId)
    {
        return Post::find($id)->getCvs()->attach($cvId);
    }

    public function unapplyPost($id, $cvId)
    {
        return Post::find($id)->getCvs()->detach($cvId);
    }


    public function createPost($employerId, $title, $work, $level, $experience, $skills, $degree, $workingForm, $sex, $city, $address, $minSalary, $maxSalary, $numberApplicants, $description, $benefit, $endDate)
    {
        $data = [
            'employer_id' => $employerId,
            'title' => $title,
            'work_id' => $work,
            'level_id' => $level,
            'experience_id' => $experience,
            'degree_id' => $degree,
            'working_form_id' => $workingForm,
            'sex' => $sex,
            'city_id' => $city,
            'address' => $address,
            'min_salary' => $minSalary,
            'max_salary' => $maxSalary,
            'number_applicants' => $numberApplicants,
            'description' => $description,
            'benefit' => $benefit,
            'end_date' => $endDate,
            'status' => $this->getStatusPending(),
        ];
        $post = Post::create($data);
        $skill_ids = [];
        foreach ((array)$skills as $skill) {
            $skill_ids[] = $this->skillRepository->getIdBySkillName($skill);
        }
        $post->getSkills()->sync($skill_ids);
        return (array)$post;
    }

    public function getPost($id)
    {
        $post = DB::table('posts as tp')
            ->where('tp.id', '=', $id)
            ->where('tp.status', '!=', $this->getStatusDelete())
            ->join('works as tw', 'tp.work_id', '=', 'tw.id')
            ->join('levels as tl', 'tp.level_id', '=', 'tl.id')
            ->join('experiences as te', 'tp.experience_id', '=', 'te.id')
            ->join('degrees as td', 'tp.degree_id', '=', 'td.id')
            ->join('working_forms as twf', 'tp.working_form_id', '=', 'twf.id')
            ->join('cities as tc', 'tp.city_id', '=', 'tc.id')
            ->select('tp.id as id',
                'tp.employer_id as employer_id',
                'tp.title as title',
                'tw.name as work',
                'tp.work_id as work_id',
                'tl.name as level',
                'tp.level_id as level_id',
                'te.name as experience',
                'tp.experience_id as experience_id',
                'td.name as degree',
                'tp.degree_id as degree_id',
                'twf.name as working_form',
                'tp.working_form_id as working_form_id',
                'tp.sex as sex',
                'tc.name as city',
                'tp.city_id as city_id',
                'tp.address as address',
                'tp.min_salary as min_salary',
                'tp.max_salary as max_salary',
                'tp.number_applicants as number_applicants',
                'tp.description as description',
                'tp.benefit as benefit',
                'tp.end_date as end_date',
                'tp.is_pinned as is_pinned',
                'tp.status as status',
                'tp.note as note',
                'tp.created_at as created_at',
                'tp.updated_at as updated_at',
            )
            ->latest()
            ->get()
            ->toArray();
        if ($post) {
            $post = (array)$post;
            $post[0]->skills = $this->skillRepository->getSkillsOfPost($id);
            if ($post[0]->sex == 1) {
                $post[0]->txtsex = "Nam";
            } elseif ($post[0]->sex == 2) {
                $post[0]->txtsex = "Nữ";
            } else {
                $post[0]->txtsex = "Không yêu cầu";
            }
        }
        return $post;
    }

    public function confirmPost($id)
    {
        $data = [
            'status' => $this->getStatusConfirm(),
            'note' => '',
            'manager_id' => auth('manager')->user()->id,
        ];
        $post = Post::find($id);
        return $post->update($data);
    }

    public function cancelPost($id, $note)
    {
        $data = [
            'status' => $this->getStatusCancel(),
            'note' => $note,
            'manager_id' => auth('manager')->user()->id,
        ];
        $post = Post::find($id);
        return $post->update($data);
    }

    public function updatePost($id, $title, $work, $level, $experience, $skills, $degree, $workingForm, $sex, $city, $address, $minSalary, $maxSalary, $numberApplicants, $description, $benefit, $endDate)
    {
        $data = [
            'title' => $title,
            'work_id' => $work,
            'level_id' => $level,
            'experience_id' => $experience,
            'degree_id' => $degree,
            'working_form_id' => $workingForm,
            'sex' => $sex,
            'city_id' => $city,
            'address' => $address,
            'min_salary' => $minSalary,
            'max_salary' => $maxSalary,
            'number_applicants' => $numberApplicants,
            'description' => $description,
            'benefit' => $benefit,
            'end_date' => $endDate,
            'status' => $this->getStatusPending()
        ];
        $post = Post::find($id);
        $skill_ids = [];
        foreach ((array)$skills as $skill) {
            $skill_ids[] = $this->skillRepository->getIdBySkillName($skill);
        }
        $post->getSkills()->sync($skill_ids);
        return $post->update($data);
    }

    public function deletePost($id)
    {
        $data = [
            'status' => $this->getStatusDelete(),
            'note' => '',
        ];
        $post = Post::find($id);
        return $post->update($data);
    }

    public function getPostsByWorkId($work_id)
    {
        $data = [];
        $posts = DB::table('posts as tp')
            ->where('tp.work_id', '=', $work_id)
            ->where('tp.status', '!=', $this->getStatusDelete())
            ->join('works as tw', 'tp.work_id', '=', 'tw.id')
            ->join('levels as tl', 'tp.level_id', '=', 'tl.id')
            ->join('experiences as te', 'tp.experience_id', '=', 'te.id')
            ->join('degrees as td', 'tp.degree_id', '=', 'td.id')
            ->join('working_forms as twf', 'tp.working_form_id', '=', 'twf.id')
            ->join('cities as tc', 'tp.city_id', '=', 'tc.id')
            ->select('tp.id as id', 'tp.title as title',
                'tp.employer_id as employer_id',
                'tw.name as work', 'tl.name as level',
                'te.name as experience', 'td.name as degree', 'twf.name as working_form', 'tp.sex as sex', 'tc.name as city',
                'tp.address as address', 'tp.min_salary as min_salary', 'tp.max_salary as max_salary',
                'tp.number_applicants as number_applicants',
                'tp.description as description',
                'tp.benefit as benefit',
                'tp.end_date as end_date',
                'tp.is_pinned as is_pinned',
                'tp.status as status',
                'tp.note as note',
                'tp.created_at as created_at',
                'tp.updated_at as updated_at',
            )
            ->get()
            ->toArray();
        $posts = array_slice($posts, 0, 9);
        foreach ($posts as $post) {
            $post = (array)$post;
            $post['avatar'] = $this->employerRepository->getEmployer($post['employer_id'])['avatar'];
            $data[] = $post;
        }
        return $data;
    }

    public function buyPin($id, $employer_id, $total)
    {
        if ($this->employerRepository->subBalance($employer_id, $total)) {
            $data = [
                'is_pinned' => true,
            ];
            $post = Post::find($id);
            return $post->update($data);
        } else {
            return false;
        }
    }

    public function findPosts($search, $level, $city)
    {
        $data = [];
        $posts = DB::table('posts as tp')
            ->where('tp.status', '=', $this->getStatusConfirm())
            ->where('tp.title', 'like', '%' . $search . '%')
            ->where(function ($query) use ($city) {
                if ($city != 1)
                    $query->where('tp.city_id', '=', $city);
            })
            ->where(function ($query) use ($level) {
                if ($level != 0)
                    $query->where('tp.level_id', '=', $level);
            })
            ->join('works as tw', 'tp.work_id', '=', 'tw.id')
            ->join('levels as tl', 'tp.level_id', '=', 'tl.id')
            ->join('experiences as te', 'tp.experience_id', '=', 'te.id')
            ->join('degrees as td', 'tp.degree_id', '=', 'td.id')
            ->join('working_forms as twf', 'tp.working_form_id', '=', 'twf.id')
            ->join('cities as tc', 'tp.city_id', '=', 'tc.id')
            ->select('tp.id as id', 'tp.title as title',
                'tp.employer_id as employer_id',
                'tw.name as work', 'tl.name as level',
                'te.name as experience', 'td.name as degree', 'twf.name as working_form', 'tp.sex as sex', 'tc.name as city',
                'tp.address as address', 'tp.min_salary as min_salary', 'tp.max_salary as max_salary',
                'tp.number_applicants as number_applicants',
                'tp.description as description',
                'tp.benefit as benefit',
                'tp.end_date as end_date',
                'tp.is_pinned as is_pinned',
                'tp.status as status',
                'tp.note as note',
                'tp.created_at as created_at',
                'tp.updated_at as updated_at',
            )
            ->paginate(9)
            ->toArray()['data'];
        foreach ($posts as $post) {
            $post = (array)$post;
            $post['avatar'] = $this->employerRepository->getEmployer($post['employer_id'])['avatar'];
            $data[] = $post;
        }
//        dd($posts);
        return $data;
    }
}
