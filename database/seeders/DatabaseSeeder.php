<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear permisos
        $permissions = [
            'permission-create',
            'permission-edit',
            'permission-delete',
            'permission-view',
            'role-create',
            'role-edit',
            'role-delete',
            'role-view',
            'user-create',
            'user-edit',
            'user-delete',
            'user-view',
            'product-view',
            'product-create',
            'product-edit',
            'product-delete',
            'activitylog-view',
            'activitylog-create',
            'activitylog-edit',
            'activitylog-delete',
            'antecedente-view',
            'antecedente-create',
            'antecedente-edit',
            'antecedente-delete',
            'cita-view',
            'cita-create',
            'cita-edit',
            'cita-delete',
            'recipe-view',
            'recipe-create',
            'recipe-edit',
            'recipe-delete',
            'doctor-view',
            'doctor-create',
            'doctor-edit',
            'doctor-delete',
            'evaluacion-view',
            'evaluacion-create',
            'evaluacion-edit',
            'evaluacion-delete',
            'historia-view',
            'historia-create',
            'historia-edit',
            'historia-delete',
            'informe-view',
            'informe-create',
            'informe-edit',
            'informe-delete',
            'paciente-view',
            'paciente-create',
            'paciente-edit',
            'paciente-delete',
            'producto-view',
            'producto-create',
            'producto-edit',
            'producto-delete',
            'tipo-antecedente-view',
            'tipo-antecedente-create',
            'tipo-antecedente-edit',
            'tipo-antecedente-delete',
            'tipo-cita-view',
            'tipo-cita-create',
            'tipo-cita-edit',
            'tipo-cita-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'sanctum']);
        }

        // Crear roles
        $superAdminRole = Role::create(['name' => 'Super Admin', 'guard_name' => 'sanctum']);
        $adminRole = Role::create(['name' => 'admin', 'guard_name' => 'sanctum']);
        $userRole = Role::create(['name' => 'user', 'guard_name' => 'sanctum']);

        // Asignar todos los permisos al rol super admin
        $superAdminRole->givePermissionTo($permissions);

        // Asignar permisos básicos al rol admin
        $adminRole->givePermissionTo([
            'user-create',
            'user-edit',
            'user-delete',
            'user-view',
            'product-view',
            'product-create',
            'product-edit',
            'product-delete'
        ]);

        // Asignar permisos básicos al rol user
        $userRole->givePermissionTo([
            'user-create',
            'user-edit',
            'user-delete',
            'user-view'
        ]);

        // Creating Super Admin User
        $superAdmin = User::create([
            'name' => 'Silvio Ramírez', 
            'email' => 'silvio.ramirez.m@gmail.com',
            'password' => Hash::make('secret')
        ]);
        $superAdmin->assignRole('Super Admin');

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
