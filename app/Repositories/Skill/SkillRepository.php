<?php

namespace App\Repositories\Skill;


use App\Models\Skill;
use Illuminate\Support\Facades\DB;

class SkillRepository implements SkillRepositoryInterface
{
    public function getAllSkills()
    {
        return Skill::all()->toArray();
    }

    public function getIdBySkillName($skill)
    {
        $skill = Skill::firstOrCreate(['name' => $skill]);
        return $skill->id;
    }

    public function getSkillsOfCv($cv_id)
    {
        $data = [];
        $skills = DB::table('cv_skill as tcs')
            ->where('cv_id', '=', $cv_id)
            ->join('skills as ts', 'tcs.skill_id', '=', 'ts.id')
            ->select('ts.id as id', 'ts.name as name', 'tcs.description as description')
            ->get()
            ->toArray();
        foreach ($skills as $skill) {
            $data[] = (array)$skill;
        }
        return $data;
    }

    public function getSkillsOfPost($post_id)
    {
        $data = [];
        $skills = DB::table('post_skill as tps')
            ->where('post_id', '=', $post_id)
            ->join('skills as ts', 'tps.skill_id', '=', 'ts.id')
            ->select('ts.id as id', 'ts.name as name')
            ->get()
            ->toArray();
        foreach ($skills as $skill) {
            $data[] = (array)$skill;
        }
        return $data;
    }
}
