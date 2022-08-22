<?php

namespace Database\Seeders;

use App\Models\Manager;
use Illuminate\Database\Seeder;

class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = Manager::create([
            'name'=>'Admin',
            'email'=>'phuongadmin@gmail.com',
            'password'=>bcrypt('admin'),
        ]);
        $user->getRoles()->sync([1]);
    }
}
