<?php

namespace Database\Seeders;

use App\Models\Work;
use Illuminate\Database\Seeder;

class WorkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $works = config('setting.works');
        foreach ($works as $work)
        {
            Work::create([
                'name'=>$work
            ]);
        }
    }
}
