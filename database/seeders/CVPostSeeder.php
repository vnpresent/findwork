<?php

namespace Database\Seeders;

use App\Models\Cv;
use App\Models\Post;
use Illuminate\Database\Seeder;

class CVPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $num_post = Post::all()->count();
        $num_cv = Cv::all()->count();
        for ($z = 0; $z < 50; $z++) {
            $id = random_int(1, $num_post);
            for ($g = 0; $g < random_int(1, 10); $g++) {
                Post::find($id)->getCvs()->attach(random_int(1, $num_cv));
//                Post::find($id)->getCvs()->attach(random_int(1, $num_cv));
            }
        }
    }
}
