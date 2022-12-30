<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Degree;
use App\Models\Employer;
use App\Models\Experience;
use App\Models\Level;
use App\Models\Post;
use App\Models\Work;
use App\Models\WorkingForm;
use App\Traits\GetStatusTrait;
use Faker\Factory;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    use GetStatusTrait;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('vi_VN');
        for ($i = 0; $i < 50; $i++) {
            $data = [
                'employer_id' => random_int(1, Employer::all()->count()),
                'title' => $faker->jobTitle,
                'work_id' => random_int(1, Work::all()->count()),
                'level_id' => random_int(1, Level::all()->count()),
                'experience_id' => random_int(1, Experience::all()->count()),
                'degree_id' => random_int(1, Degree::all()->count()),
                'working_form_id' => random_int(1, WorkingForm::all()->count()),
                'sex' => random_int(0,2),
                'city_id' => random_int(1, City::all()->count()),
                'address' => $faker->address,
                'min_salary' => random_int(1,5),
                'max_salary' => random_int(6, 15),
                'number_applicants' => random_int(3, 15),
                'description' => $faker->text,
                'benefit' => $faker->text,
                'end_date' => now()->addDay(random_int(5,25)),
                'status' => random_int(1,4),
            ];
            Post::create($data);
        }
    }
}
