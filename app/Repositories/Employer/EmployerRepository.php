<?php

namespace App\Repositories\Employer;

use App\Models\Employer;
use App\Repositories\Setting\SettingRepositoryInterface;
use Illuminate\Support\Facades\DB;

class EmployerRepository implements EmployerRepositoryInterface
{


    protected $settingRepository;

    public function __construct(SettingRepositoryInterface $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    public function getAllEmployers()
    {
        return Employer::all();
    }

    public function getEmployer($id)
    {
        return Employer::find($id)->toArray();
    }

    public function getPostsOfEmployer($id)
    {
        return Employer::find($id)->getPosts;
    }

    public function updateEmployer($id, $name, $password)
    {
        $data = [];
        if ($name !== null) {
            $data['name'] = $name;
        }
        if ($name !== null) {
            $data['password'] = bcrypt($password);
        }
        $employer = Employer::find($id);
        return $employer->update($data);
    }

    public function deleteEmployer($id)
    {
        return Employer::find($id)->delete();
    }

    public function addBalance($employer_id, $amount)
    {
        DB::beginTransaction();
        try {
            $employer = Employer::find($employer_id);
            $result = $employer->update([
                'balance' => $employer->balance + $amount,
            ]);
            DB::commit();
            return $result;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public function subBalance($employer_id, $amount)
    {
        DB::beginTransaction();
        try {
            $employer = Employer::find($employer_id);
            $result = $employer->update([
                'balance' => $employer->balance - $amount,
            ]);
            DB::commit();
            return $result;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public function updateAvatar($employer_id, $avatar)
    {
        $employer = Employer::find($employer_id);
        return $employer->update([
            'avatar' => $avatar,
        ]);
    }

    public function updateProfile($employer_id, $name, $description, $address)
    {
        $employer = Employer::find($employer_id);
        return $employer->update([
            'name' => $name,
            'description' => $description,
            'address' => $address,
        ]);
    }

    public function changePassword($employer_id, $new_password)
    {
        $employer = Employer::find($employer_id);
        return $employer->update([
            'password' => bcrypt($new_password),
        ]);
    }

    public function buyCv($employer_id, $id)
    {
        $price = $this->settingRepository->getCVPrice();
        if ($this->subBalance($employer_id, $price)) {
            auth('employer')->user()->getCvs()->attach($id);
            return true;
        } else {
            return false;
        }
    }
}
