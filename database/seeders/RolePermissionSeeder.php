<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Daftar permission
        $permissions = [
            'tambah-dokter',
            'ubah-dokter',
            'hapus-dokter',
            'lihat-dokter',
            'lihat-kontak',
            'lihat-adopsi',
            'tambah-adopsi',
            'ubah-adopsi',
            'hapus-adopsi',
            'tambah-artikel',
            'ubah-artikel',
            'hapus-artikel',
            'tambah-kontak',
        ];

        // Buat permission jika belum ada
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Buat role jika belum ada
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        // Permissions untuk admin
        $adminPermissions = [
            'tambah-dokter',
            'ubah-dokter',
            'hapus-dokter',
            'tambah-artikel',
            'ubah-artikel',
            'hapus-artikel',
            'lihat-dokter',
            'lihat-kontak',
            'lihat-adopsi',
        ];

        // Permissions untuk user
        $userPermissions = [
            'lihat-dokter',
            'tambah-adopsi',
            'ubah-adopsi',
            'hapus-adopsi',
            'tambah-artikel',
            'ubah-artikel',
            'hapus-artikel',
            'tambah-kontak',
        ];

        // Beri permission ke role admin
        $adminRole->syncPermissions($adminPermissions);

        // Beri permission ke role user
        $userRole->syncPermissions($userPermissions);
    }
}
