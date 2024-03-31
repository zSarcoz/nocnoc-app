<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role_admin = Role::create(["name"=>"admin"]);
        $role_user = Role::create(["name"=>"user"]);

        // Creation of permissions
        $permission_create_user = Permission::create(["name"=>"create user"]);
        $permission_read_user = Permission::create(["name"=>"read user"]);
        $permission_update_user = Permission::create(["name"=>"update user"]);
        $permission_delete_user = Permission::create(["name"=>"delete user"]);
        
        $permission_create_role = Permission::create(["name"=>"create roles"]);
        $permission_read_role = Permission::create(["name"=>"read roles"]);
        $permission_update_role = Permission::create(["name"=>"update roles"]);
        $permission_delete_role = Permission::create(["name"=>"delete roles"]);

        $permission_create_task = Permission::create(["name"=> "create tasks"]);
        $permission_read_task = Permission::create(["name"=> "read tasks"]);
        $permission_update_task = Permission::create(["name"=> "update tasks"]);
        $permission_delete_task = Permission::create(["name"=> "delete tasks"]);

        $permissions_admin = [$permission_create_user,$permission_read_user,
        $permission_update_user,$permission_delete_user,$permission_create_role, $permission_read_role, $permission_update_role, 
        $permission_delete_role, $permission_create_task,$permission_read_task,
        $permission_update_task,$permission_delete_task];

        $permission_user = [$permission_read_task,$permission_update_task];
        

        $role_admin->syncPermissions($permissions_admin);
        $role_user->syncPermissions($permission_user);
    }
}
