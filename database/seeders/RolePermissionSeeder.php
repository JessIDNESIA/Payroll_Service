<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'tambah-user',
            'update-user',
            'lihat-user',
            'hapus-user',
            'tambah-tulisan',
            'update-tulisan',
            'lihat-tulisan',
            'hapus-tulisan',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $roleAdmin = Role::firstOrCreate(['name' => 'admin']);
        $roleUser = Role::firstOrCreate(['name' => 'user']);

        $roleAdmin->syncPermissions(Permission::all());

        $roleUser->syncPermissions([
            'tambah-tulisan',
            'update-tulisan',
            'lihat-tulisan',
            'hapus-tulisan',
        ]);
    }
}

