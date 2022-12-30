<?php

namespace Database\Seeders;

use App\Models\Applicant;
use Illuminate\Database\Seeder;

class ApplicantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Applicant::create([
            'name' => 'Nguyễn Việt Phương',
            'phone' => '0337646311',
            'email' => 'present@present.com',
            'password' => bcrypt('vietphuong2k'),
        ]);
        Applicant::create([
            'name' => 'Nguyễn Văn Bình',
            'phone' => '0337646312',
            'email' => 'binh@present.com',
            'password' => bcrypt('vietphuong2k'),
        ]);
        Applicant::create([
            'name' => 'Nguyễn Văn Chương',
            'phone' => '0337646313',
            'email' => 'chuong@present.com',
            'password' => bcrypt('vietphuong2k'),
        ]);
        Applicant::create([
            'name' => 'Nguyễn Văn Phong',
            'phone' => '0337646313',
            'email' => 'phong@present.com',
            'password' => bcrypt('vietphuong2k'),
        ]);
        Applicant::create([
            'name' => 'Nguyễn Văn Tuấn',
            'phone' => '0337646314',
            'email' => 'tuan@present.com',
            'password' => bcrypt('vietphuong2k'),
        ]);
        Applicant::create([
            'name' => 'Trần Xuân Trường',
            'phone' => '0337646334',
            'email' => 'truong@present.com',
            'password' => bcrypt('vietphuong2k'),
        ]);
        Applicant::create([
            'name' => 'Trần Hoài Đức',
            'phone' => '0337646324',
            'email' => 'tranduc@present.com',
            'password' => bcrypt('vietphuong2k'),
        ]);
        Applicant::create([
            'name' => 'Đào Thu Hương',
            'phone' => '0337646315',
            'email' => 'huong@present.com',
            'password' => bcrypt('vietphuong2k'),
        ]);
        Applicant::create([
            'name' => 'Nguyễn Vân Ánh',
            'phone' => '0337146315',
            'email' => 'vananh@present.com',
            'password' => bcrypt('vietphuong2k'),
        ]);
        Applicant::create([
            'name' => 'Đàm Văn Tuân',
            'phone' => '0337146315',
            'email' => 'dvantuan@present.com',
            'password' => bcrypt('vietphuong2k'),
        ]);
    }
}
