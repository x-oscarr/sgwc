<?php

use Illuminate\Database\Seeder;
use PHPZen\LaravelRbac\Model\Role;
use PHPZen\LaravelRbac\Model\Permission;

class RoleSeeder extends Seeder
{
    protected $roles = [
        [
            'name' => 'General admin',
            'slug' => 'root',
            'description' => 'The role of the general administrator'
        ],
        [
            'name' => 'Admin',
            'slug' => 'admin',
            'description' => 'Admin role'
        ],
        [
            'name' => 'Editor',
            'slug' => 'editor',
            'description' => 'Role of editor'
        ],
    ];

    protected $permissions = [
        [
            'name' => 'Admin Panel',
            'slug' => 'page.admin.panel',
            'description' => 'Access to admin panel',
            'roles' => ['root', 'admin']
        ],
        [
            'name' => 'Site Settings',
            'slug' => 'page.settings',
            'description' => 'Access to site settings',
            'roles' => ['root']
        ],
        [
            'name' => 'Site Tools',
            'slug' => 'page.tools',
            'description' => 'Access to site tools',
            'roles' => ['root', 'admin']
        ],
        [
            'name' => 'Reports All permission',
            'slug' => 'report.all',
            'description' => 'All access to reports',
            'roles' => ['root', 'admin']
        ],
        [
            'name' => 'Reports Edit permission',
            'slug' => 'report.edit',
            'description' => 'Access to change reports',
            'roles' => ['root', 'admin']
        ],
        [
            'name' => 'Reports Panel',
            'slug' => 'page.reports.panel',
            'description' => 'Access to reports panel',
            'roles' => ['root', 'admin', 'editor']
        ],
    ];

    public function run()
    {
        foreach ($this->roles as $role) {
            $adminRole = new Role;
            $adminRole->name = $role['name'];
            $adminRole->slug = $role['slug'];
            $adminRole->description = $role['description'];
            $adminRole->save();
        }

        foreach ($this->permissions as $permission) {
            $permissionModel = new Permission;
            $permissionModel->name = $permission['name'];
            $permissionModel->slug = $permission['slug'];
            $permissionModel->description = $permission['description'];
            $permissionModel->save();
            foreach ($permission['roles'] as $role) {
                $adminRole = Role::where('slug', $role)->first();
                $adminRole->permissions()->attach($permissionModel->id);
            }
        }
    }
}
