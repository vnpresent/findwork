<?php

namespace App\Services\ValidateInputServices;

use Illuminate\Support\Facades\Validator;

class validateInputRoleService
{
    public function validateInputCreateRole($name, $permissions)
    {
        $data = [
            'name' => $name,
            'permissions' => $permissions,
        ];
        $validate = Validator::make($data, [
            'name' => 'required|string|unique:roles,name',
            'permissions' => 'nullable|array',
            'permissions[]' => 'nullable|exists:permissions,id',
        ], [
            'name.required' => 'Tên role không được để trống.',
            'name.string' => 'Tên role phải là chuỗi',
            'name.unique' => 'Tên role đã tồn tại.',
            'permissions.array' => 'Lỗi chọn quyền',
            'permissions[].exists' => 'Lỗi chọn quyền',
        ]);
        if ($validate->fails()) {
            redirect()->back()->with(['error' => $validate->errors()->first()])->withInput();
        } else {
            return true;
        }
    }

    public function validateInputUpdateRole($name, $permissions)
    {
        $data = [
            'name' => $name,
            'permissions' => $permissions,
        ];
        $validate = Validator::make($data, [
            'name' => 'required|string',
            'permissions' => 'nullable|array',
            'permissions[]' => 'nullable|exists:permissions,id',
        ], [
            'name.required' => 'Tên role không được để trống.',
            'name.string' => 'Tên role phải là chuỗi',
            'name.unique' => 'Tên role đã tồn tại.',
            'permissions.array' => 'Lỗi chọn quyền',
            'permissions[].exists' => 'Lỗi chọn quyền',
        ]);
        if ($validate->fails()) {
            redirect()->back()->with(['error' => $validate->errors()->first()])->withInput();
        } else {
            return true;
        }
    }
}
