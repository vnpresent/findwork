<?php

namespace App\Traits;

trait CheckExistTrait
{
    private function checkExists($data, $subject)
    {
        if (is_array($data) && count($data) > 0) {
            return true;
        } else {
            return redirect()->back()->with(['error' => 'Không tồn tại ' . $subject . ' này!'])->withInput();
        }
    }

    public function checkExistsManager($manager)
    {
        return $this->checkExists($manager, 'Tài khoản quản lý');
    }

    public function checkExistsPost($post)
    {
        return $this->checkExists($post, 'Post');
    }

    public function checkExistsRole($role)
    {
        return $this->checkExists($role, 'Role');
    }
}
