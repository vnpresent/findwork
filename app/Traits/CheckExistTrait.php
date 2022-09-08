<?php

namespace App\Traits;

trait CheckExistTrait
{
    private function checkExists($data, $subject)
    {
        if (count($data) > 0) {
            return true;
        } else {
            return redirect()->back()->with(['error' => 'Không tồn tại ' . $subject . ' này!'])->withInput();
        }
    }

    public function checkExistsRole($role)
    {
        return $this->checkExists($role, 'Role');
    }

    public function checkExistsPost($post)
    {
        return $this->checkExists($post, 'Post');
    }
}
