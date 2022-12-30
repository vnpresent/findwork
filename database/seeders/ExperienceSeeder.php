<?php

namespace Database\Seeders;

use App\Models\Experience;
use Illuminate\Database\Seeder;

class ExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $experiences = config('setting.experiences');
        foreach ($experiences as $experience) {
            Experience::create([
                'name' => $experience
            ]);
        }
    }
}
