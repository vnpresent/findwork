<?php

namespace App\Traits;

trait GetStatusTrait
{
    public function getStatusById($id)
    {
        return config('setting.status.' . $id);
    }

    public function getStatusPending()
    {
        return 2;
    }

    public function getStatusConfirm()
    {
        return 1;
    }

    public function getStatusCancel()
    {
        return 0;
    }


    public function getStatusDelete()
    {
        return 3;
    }
}
