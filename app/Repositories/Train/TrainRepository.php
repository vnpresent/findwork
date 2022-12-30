<?php

namespace App\Repositories\Train;

use App\Models\Work;
use Illuminate\Support\Facades\DB;

class TrainRepository implements TrainRepositoryInterface
{
    public function getValue($skill_id, $work_id)
    {
        return DB::table('models')
            ->where('skill_id', '=', $skill_id)
            ->where('work_id', '=', $work_id)
            ->select(['value'])
            ->latest()
            ->get()->toArray();
    }
}
