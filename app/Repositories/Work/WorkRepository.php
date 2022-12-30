<?php

namespace App\Repositories\Work;

use App\Models\Work;

class WorkRepository implements WorkRepositoryInterface
{
    public function getAllWorks()
    {
        return Work::all()->toArray();
    }
}
