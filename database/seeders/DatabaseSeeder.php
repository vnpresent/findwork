<?php

namespace Database\Seeders;

use App\Models\Experience;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(ManagerSeeder::class);
        $this->call(WorkSeeder::class);
        $this->call(LevelSeeder::class);
        $this->call(ExperienceSeeder::class);
        $this->call(DegreeSeeder::class);
        $this->call(WorkingFormSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(EmployerSeeder::class);
        $this->call(ApplicantSeeder::class);
        $this->call(SkillSeeder::class);
//        $this->call(PostSeeder::class);
//        $this->call(CVSeeder::class);
//        $this->call(CVPostSeeder::class);
    }
}
