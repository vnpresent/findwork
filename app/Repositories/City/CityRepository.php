<?php

namespace App\Repositories\City;


use App\Models\City;

class CityRepository implements CityRepositoryInterface
{
    public function getAllCitíes()
    {
        return City::all()->toArray();
    }

    public function getCity($id)
    {
        return City::find($id)->toArray();
    }
}
