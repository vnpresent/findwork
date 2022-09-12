<?php

namespace App\Services\RoleService;

use App\Interfaces\RoleRepositoryInterface;
use App\Traits\CheckExistTrait;

class showRoleService
{
    use CheckExistTrait;

    protected $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function showRoleForm($id)
    {
        try {
            // lấy thông tin role cần hiển thị,kiểm tra xem bản ghi có rỗng không,nếu có thông báo không tồn tại role
            $role = $this->roleRepository->getRole($id);
            if ($this->checkExistsRole($role) !== true) {
                return $this->checkExistsRole($role);
            }
            // nếu không,trả về view kèm bản ghi role vừa lấy đươc
            return view('role.show_role', ['role' => $role]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
        }
    }
}
