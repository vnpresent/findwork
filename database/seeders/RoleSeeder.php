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
    }
}
