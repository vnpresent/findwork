<?php

namespace App\Repositories\Skill;


interface SkillRepositoryInterface
{
    public function getAllSkills();

    public function getIdBySkillName($skill);

    public function getSkillsOfCv($cv_id);

    public function getSkillsOfPost($post_id);
}
