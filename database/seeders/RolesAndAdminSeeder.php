<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\PermissionRegistrar;
use Spatie\Permission\Models\Role;

class RolesAndAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions to prevent errors when re-seeding
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. Create Permissions
        $permissions = [
            'view-users', 'edit-users', 'delete-users', 'assign-roles',
            'create-content', 'edit-content', 'delete-content', 'publish-content',
            'manage-programs', 'view-registrations', 'export-thanksgiving',
            'send-notifications', 'manage-templates',
            'review-testimonies', 'manage-resources', 'manage-groups'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // 2. Create Roles & Assign Specific Permissions
        $usherRole = Role::create(['name' => 'ushers']); // Or whatever your app expects
        $mediaRole = Role::create(['name' => 'media-and-communications']); 

        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all());
        $adminRole->revokePermissionTo(['assign-roles', 'delete-users']);

        $superAdminRole = Role::create(['name' => 'super-admin']);
        $memberRole = Role::create(['name' => 'member']);
        // 3. Create Your Super Admin User Account
        $superAdmin = User::create([
            'name' => 'Aroyewun Oluwatobiloba John',
            'email' => 'tobilobaolutomi@gmail.com',
            'password' => Hash::make('12345678'), // Change this in production ; UPDATE: change to my actual password
            'whatsapp_number' => '08157177774', // Example number ; UPDATE: changed to my actual number
            'email_verified_at' => now(),
        ]);

        // 4. Assign the Super Admin role to your account
        $superAdmin->assignRole($superAdminRole);
    }
}
