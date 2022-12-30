<?php

namespace App\Repositories\Degree;


use App\Models\Degree;

class DegreeRepository implements DegreeRepositoryInterface
{
    public function getAllDegrees()
    {
        return Degree::all()->toArray();
    }
}
