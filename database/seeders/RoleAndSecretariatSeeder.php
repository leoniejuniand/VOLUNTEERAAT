<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Secretariat;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Support\Facades\Hash;

class RoleAndSecretariatSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cache dari Spatie Permission
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. Memasukkan Data 6 Sekretariat
        $secretariats = [
            'Purwokerto', 
            'Bandung', 
            'Malang', 
            'Yogya', 
            'Semarang', 
            'Madiun'
        ];

        foreach ($secretariats as $sekreName) {
            Secretariat::firstOrCreate(['name' => $sekreName]);
        }

        // 2. Membuat Data Role (Hak Akses)
        $roleSuperAdmin = Role::firstOrCreate(['name' => 'super_admin']);
        $roleAdminSekre = Role::firstOrCreate(['name' => 'admin_sekre']);
        $roleRelawan = Role::firstOrCreate(['name' => 'relawan']);

        // 3. Membuat Akun Super Admin Default
        $superAdmin = User::firstOrCreate(
            ['email' => 'superadmin@aat.or.id'], // Email untuk login nanti
            [
                'name' => 'Super Admin AAT',
                'password' => Hash::make('password123'), // Password default
                'secretariat_id' => null, // Super admin tidak dibatasi 1 sekre
            ]
        );
        
        // Memberikan role super_admin ke akun tersebut
        $superAdmin->assignRole($roleSuperAdmin);
    }
}