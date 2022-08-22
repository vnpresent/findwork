<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $models = Config::get('permission.models');
        $permissions = Config::get('permission.permissions');
        foreach ($models as $model) {
            $new = Permission::create([
                'name' => ucfirst($model),
                'key_code' => $model,
            ]);
            foreach ($permissions as $permission) {
                Permission::create([
                    'parent_id' => $new->id,
                    'name' => ucfirst($permission).' '.ucfirst($model),
                    'key_code' =>  $permission.'_'.$model,
                ]);
            }
        }
    }
}
