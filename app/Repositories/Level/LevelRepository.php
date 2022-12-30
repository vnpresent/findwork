<?php

namespace App\Repositories\Level;



use App\Models\Level;

class LevelRepository implements LevelRepositoryInterface
{
    public function getAllLevels()
    {
        return Level::all()->toArray();
    }
}
