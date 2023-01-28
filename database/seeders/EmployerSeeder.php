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
            'name' => 'Công ty An Phát',
            'email' => 'present@present.com',
            'password' => bcrypt('vietphuong2k'),
            'avatar' => 'avatar/1-1672301545.jpg',
            'balance' => 1925000,
        ]);
        Employer::create([
            'name' => 'Công ty Thịnh Minh',
            'email' => 'thinhminh@present.com',
            'password' => bcrypt('vietphuong2k'),
            'avatar' => 'avatar/2-1672363548.jpg',
            'balance' => 1475000,
        ]);
        Employer::create([
            'name' => 'Công ty Hoàng Phong',
            'email' => 'hoangphong@present.com',
            'password' => bcrypt('vietphuong2k'),
            'avatar' => 'avatar/3-1672364095.jpg',
            'balance' => 250000,
        ]);
        Employer::create([
            'name' => 'Công ty Bình Minh',
            'email' => 'binhminh@present.com',
            'password' => bcrypt('vietphuong2k'),
            'avatar' => 'avatar/4-1672365815.jpg',
            'balance' => 1475000,

        ]);
        Employer::create([
            'name' => 'Công ty Hòa Phát',
            'email' => 'hoaphat@present.com',
            'password' => bcrypt('vietphuong2k'),
            'avatar' => 'avatar/5-1672366271.jpg',
            'balance' => 974999,
        ]);
        Employer::create([
            'name' => 'Công ty Bình Long',
            'email' => 'binhlong@present.com',
            'password' => bcrypt('vietphuong2k'),
            'avatar' => 'avatar/6-1672367424.jpg',
            'balance' => 85000,
        ]);
        Employer::create([
            'name' => 'Công ty Khánh Hòa',
            'email' => 'khanhhoa@present.com',
            'password' => bcrypt('vietphuong2k'),
            'avatar' => 'avatar/7-1672643210.jpg',
            'balance' => 85000,
        ]);
    }
}
