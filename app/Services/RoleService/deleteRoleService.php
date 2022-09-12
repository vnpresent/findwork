<?php

namespace App\Services\RoleService;

use App\Interfaces\RoleRepositoryInterface;
use App\Traits\CheckExistTrait;

class deleteRoleService
{
    use CheckExistTrait;

    protected $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function deleteRole($id)
    {
        try {
            // kiếm tra xem tồn tại role cần xóa không,nếu không tồn tại,back lại kèm lỗi không tồn tại role
            $role = $this->roleRepository->getRole($id);
            if ($this->checkExistsRole($role) !== true) {
                return $this->checkExistsRole($role);
            }
            // gọi repo xóa role,sau đó kiểm tra kết quả trả về và back lại kèm thông báo
            $result = $this->roleRepository->deleteRole($id);
            if ($result) {
                return redirect()->back()->with(['success' => 'Đã xóa role thành công thành công']);
            } else {
                return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau']);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau']);
        }
    }
}
