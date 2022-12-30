<?php

namespace Database\Seeders;

use App\Models\Employer;
use App\Models\Manager;
use Illuminate\Database\Seeder;

class EmployerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Employer::create([
            'name'=>'Công ty Việt Phương',
            'email'=>'present@present.com',
            'password'=>bcrypt('vietphuong2k'),
        ]);
        Employer::create([
            'name'=>'Công ty Thịnh Minh',
            'email'=>'thinhminh@present.com',
            'password'=>bcrypt('vietphuong2k'),
        ]);
        Employer::create([
            'name'=>'Công ty Hoàng Phong',
            'email'=>'hoangphong@present.com',
            'password'=>bcrypt('vietphuong2k'),
        ]);
        Employer::create([
            'name'=>'Công ty Bình Minh',
            'email'=>'binhminh@present.com',
            'password'=>bcrypt('vietphuong2k'),
        ]);
        Employer::create([
            'name'=>'Công ty Hòa Phát',
            'email'=>'hoaphat@present.com',
            'password'=>bcrypt('vietphuong2k'),
        ]);
        Employer::create([
            'name'=>'Công ty Bình Long',
            'email'=>'binhlong@present.com',
            'password'=>bcrypt('vietphuong2k'),
        ]);
    }
}
