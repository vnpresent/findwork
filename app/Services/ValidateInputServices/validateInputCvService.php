<?php

namespace App\Services\ValidateInputServices;

use Illuminate\Support\Facades\Validator;

class validateInputCvService
{
    public function validateInputCreateCv()
    {

    }

    public function validateInputUpdateCV()
    {

    }

    public function validateInputDownloadCv($id)
    {
        $data = [
            'id' => $id,
        ];
        $validate = Validator::make($data, [
            'id' => 'required|integer',
        ], [
            'id.required' => 'Id không được để trống',
            'id.integer' => 'Id phải là số',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->with(['error' => $validate->errors()->first()])->withInput();
        }
        if (auth('employer')->user() != null) {

            $applies_id = auth('employer')->user()->getCvs;
            dd($applies_id);

            return true;
        }
        if (auth('manager')->user() != null && auth('manager')->user()->hasPermission('download_cv')) {
            return true;
        }
    }
}
