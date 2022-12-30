<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create([
            'name'=>'Admin'
        ]);
        $permissions = Permission::where('parent_id','!=','0')->pluck('id')->toArray();
        $role->getPermissions()->sync($permissions);

        $role = Role::create([
            'name'=>'Bài đăng'
        ]);
        $permissions = Permission::where('parent_id','!=','0')->pluck('id')->toArray();
        $role->getPermissions()->sync($permissions);

        $role = Role::create([
            'name'=>'Nhà tuyển dụng'
        ]);
        $permissions = Permission::where('parent_id','!=','0')->pluck('id')->toArray();
        $role->getPermissions()->sync($permissions);

        $role = Role::create([
            'name'=>'Phiếu nạp'
        ]);
        $permissions = Permission::where('parent_id','!=','0')->pluck('id')->toArray();
        $role->getPermissions()->sync($permissions);
    }
}
