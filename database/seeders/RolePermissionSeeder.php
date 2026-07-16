<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cache permission
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Buat permission (sesuaikan dengan modul project kamu)
        $permissions = [
            'inventaris.view', 'inventaris.create', 'inventaris.edit', 'inventaris.delete',
            'transaksi.view', 'transaksi.create', 'transaksi.edit', 'transaksi.delete',
            'menu.view', 'menu.create', 'menu.delete',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Buat role admin -> dapat semua permission
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->syncPermissions($permissions);

        // Buat role karyawan -> permission terbatas (contoh: hanya transaksi & lihat inventaris/menu)
        $karyawan = Role::firstOrCreate(['name' => 'karyawan']);
        $karyawan->syncPermissions([
            'transaksi.view', 'transaksi.create', 'transaksi.edit',
            'inventaris.view',
            'menu.view',
        ]);
    }
}