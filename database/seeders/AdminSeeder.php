<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_suberAdmin = Role::create(['name' => 'suberadmin']);
        $role_Admin = Role::create(['name' => 'admin']);
        $role_employee = Role::create(['name' => 'employee']);


        $permission1 = Permission::create(['name' => 'edit']);
        $permission2 = Permission::create(['name' => 'softdelete']);
        $permission3 = Permission::create(['name' => 'forcedelete']);
        $permission4 = Permission::create(['name' => 'show']);
        $permission5= Permission::create(['name' => 'restore']);
        $permission6 = Permission::create(['name' => 'create']);


        $role_suberAdmin->syncPermissions([$permission1,$permission2,$permission3,
        $permission4,$permission5,$permission6]);

        $role_Admin->syncPermissions([$permission1,$permission2,$permission4,$permission6]);
        $role_employee->syncPermissions([$permission4,$permission6]);

    }
}
