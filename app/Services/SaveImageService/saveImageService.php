<?php

namespace App\Services\SaveImageService;


class saveImageService
{
    public function saveImage($image, $employer_id)
    {
        $filename = $employer_id . '-' . now()->timestamp . '.jpg';
        $image->move(public_path('avatar'), $filename);
        return 'avatar/' . $filename;
    }
}
