<?php

namespace App\Repositories\Experience;


use App\Models\Experience;

class ExperienceRepository implements ExperienceRepositoryInterface
{
    public function getAllExperiences()
    {
        return Experience::all()->toArray();
    }
}
