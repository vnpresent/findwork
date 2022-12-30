<?php

namespace Database\Seeders;

use App\Models\Applicant;
use App\Models\Cv;
use App\Models\Post;
use App\Models\Skill;
use Faker\Factory;
use Illuminate\Database\Seeder;

class CVSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('vi_VN');
        for ($i = 0; $i < 20; $i++) {
            $applicant_id = random_int(1, Applicant::all()->count());
            $name = $faker->jobTitle;
            $position = $faker->jobTitle;
            $profile = [
                'name' => $faker->lastName,
                'birthday' => $faker->date(),
                'phone' => $faker->phoneNumber,
                'email' => $faker->unique()->email,
                'address' => $faker->address,
            ];
            $objective = $faker->text;
            $skills = [];
            for ($j = 0; $j < random_int(1, 6); $j++) {
                $skills[] = [
                    'id' => random_int(1, Skill::all()->count()),
                    'description' => $faker->text
                ];
            }
            $work_experience = [];
            for ($j = 0; $j < random_int(1, 5); $j++) {
                $work_experience[] = [
                    'position' => $faker->jobTitle,
                    'from' => $faker->date(),
                    'end' => $faker->date(),
                    'name' => $faker->title(),
                    'description' => $faker->text,
                ];
            }
            $education = [];
            for ($j = 0; $j < random_int(1, 5); $j++) {
                $education[] = [
                    'major' => $faker->jobTitle,
                    'from' => $faker->date(),
                    'end' => $faker->date(),
                    'school' => $faker->city,
                    'description' => $faker->text,
                ];
            }
            $activities = [];
            for ($j = 0; $j < random_int(1, 5); $j++) {
                $activities[] = [
                    'position' => $faker->jobTitle,
                    'from' => $faker->date(),
                    'end' => $faker->date(),
                    'name' => $faker->city,
                    'description' => $faker->text,
                ];
            }
            $certifications = [];
            for ($j = 0; $j < random_int(1, 5); $j++) {
                $certifications[] = [
                    'time' => $faker->date(),
                    'name' => $faker->jobTitle,
                ];
            }
            $cv = Cv::create([
                'applicant_id' => $applicant_id,
                'name' => $name,
                'position' => $position,
                'profile' => $profile,
                'objective' => $objective,
                'work_experience' => $work_experience,
                'education' => $education,
                'activities' => $activities,
                'certifications' => $certifications,
            ]);
            foreach ($skills as $skill) {
                $cv->getSkills()->attach($skill['id'], ['description' => $skill['description']]);
            }
        }
    }
}
