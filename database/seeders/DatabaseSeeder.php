<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear permisos
        $permissions = [
            'manage users',
            'manage roles',
            'manage permissions',
            'view users',
            'view roles',
            'view permissions',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'sanctum']);
        }

        // Crear roles
        $adminRole = Role::create(['name' => 'admin', 'guard_name' => 'sanctum']);
        $userRole = Role::create(['name' => 'user', 'guard_name' => 'sanctum']);

        // Asignar todos los permisos al rol admin
        $adminRole->givePermissionTo($permissions);

        // Asignar permisos básicos al rol user
        $userRole->givePermissionTo([
            'view users',
            'view roles',
            'view permissions',
        ]);

        // Crear usuario administrador
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        // Asignar rol admin al usuario administrador
        $admin->assignRole('admin');

        // Crear usuario de prueba
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        // Asignar rol user al usuario de prueba
        $user->assignRole('user');
    }
}
