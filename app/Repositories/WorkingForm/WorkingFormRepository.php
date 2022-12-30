<?php

namespace App\Repositories\WorkingForm;


use App\Models\WorkingForm;

class WorkingFormRepository implements WorkingFormRepositoryInterface
{
    public function getAllWorkingForms()
    {
        return WorkingForm::all()->toArray();
    }
}
