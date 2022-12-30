<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = config('setting.cities');
        foreach ($cities as $city) {
            City::create([
                'name' => $city
            ]);
        }
    }
}
