<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoleAndPermissionsSedder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        //USER MODEL
        $userPermission1 =  Permission::create(['name'=>'create:user', 'description'=>'create user']);
        $userPermission2 =  Permission::create(['name'=>'read:user', 'description'=>'read user']);
        $userPermission3 =  Permission::create(['name'=>'update:user', 'description'=>'update user']);
        $userPermission4 =  Permission::create(['name'=>'delete:user', 'description'=>'delete user']);

        //ROLE MODEL

        $rolePermission1 =  Permission::create(['name' => 'create:role', 'description' => 'create role']);
        $rolePermission2 =  Permission::create(['name' => 'read:role', 'description' => 'read role']);
        $rolePermission3 =  Permission::create(['name' => 'update:role', 'description' => 'update role']);
        $rolePermission4 =  Permission::create(['name' => 'delete:role', 'description' => 'delete role']);

        //PERMISSION MODEL

        $permission1 =  Permission::create(['name' => 'create:permission', 'description' => 'create permission']);
        $permission2 =  Permission::create(['name' => 'read:permission', 'description' => 'read permission']);
        $permission3 =  Permission::create(['name' => 'update:permission', 'description' => 'update permission']);
        $permission4 =  Permission::create(['name' => 'delete:permission', 'description' => 'delete permission']);

        //ADMIN MODEL

        $adminPermission1 =  Permission::create(['name' => 'read:admin', 'description' => 'read admin']);
        $adminPermission2 =  Permission::create(['name' => 'update:admin', 'description' => 'update admin']);

        $superAdminRole   = Role::create(['name'=>'super-admin']);
        $adminRole   = Role::create(['name'=>'admin']);
        $userRole   = Role::create(['name'=>'user']);
       
        $superAdminRole->syncPermissions([
            $userPermission1,
            $userPermission2,
            $userPermission3,
            $userPermission4,
            $rolePermission1,
            $rolePermission2,
            $rolePermission3,
            $rolePermission4,
            $permission1,
            $permission2,
            $permission3,
            $permission4,
            $adminPermission1,
            $adminPermission2,
            $adminRole,
            $userRole
        ]);

        $adminRole->syncPermissions([$userPermission1,
            $userPermission2,
            $userPermission3,
            $userPermission4,
            $rolePermission1,
            $rolePermission2,
            $rolePermission3,
            $rolePermission4,
            $permission1,
            $permission2,
            $permission3,
            $permission4,
            $adminPermission1,
            $adminPermission2,
            $adminRole,
            $userRole
        ]);

        $userRole->syncPermissions([$userPermission1,
            $userPermission2,
            $userPermission3,
            $userPermission4,
            $rolePermission1,
            $rolePermission2,
            $rolePermission3,
            $rolePermission4,
            $permission1,
            $permission2,
            $permission3,
            $permission4,
            $adminPermission1,
            $adminPermission2,
            $adminRole,
            $userRole
        ]);

        $superAdmin = User::create([
            'name' => 'super admin',
            'is_admin' => 1,
            'email'=>'super@admin.com',
            'email_verified_at'=>now(),
            'password'=>Hash::make('rainnda11'),
            'remember_token'=>Str::random(10),
        ]);

        $admin = User::create([
            'name' => 'admin',
            'is_admin' => 1,
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('rainnda11'),
            'remember_token' => Str::random(10),
        ]);

        $user = User::create([
            'name' => 'user',
            'is_admin' => 0,
            'email' => 'user@test.com',
            'email_verified_at' => now(),
            'password' => Hash::make('rainnda11'),
            'remember_token' => Str::random(10),
        ]);

        $superAdmin->syncRoles([$superAdminRole])->syncPermissions([$userPermission1,
            $userPermission2,
            $userPermission3,
            $userPermission4,
            $rolePermission1,
            $rolePermission2,
            $rolePermission3,
            $rolePermission4,
            $permission1,
            $permission2,
            $permission3,
            $permission4,
            $adminPermission1,
            $adminPermission2,
            $adminRole,
            $userRole
        ]);

        $admin->syncRoles([$adminRole])->syncPermissions([
            $userPermission1,
            $userPermission2,
            $userPermission3,
            $userPermission4,
            $rolePermission1,
            $rolePermission2,
            $rolePermission3,
            $rolePermission4,
            $permission1,
            $permission2,
            $permission3,
            $permission4,
            $adminPermission1,
            $adminPermission2,
            $adminRole,
            $userRole
        ]);

        $user->syncRoles([$userRole])->syncPermissions([
            $userPermission1,
            $userPermission2,
            $userPermission3,
            $userPermission4,
            $rolePermission1,
            $rolePermission2,
            $rolePermission3,
            $rolePermission4,
            $permission1,
            $permission2,
            $permission3,
            $permission4,
            $adminPermission1,
            $adminPermission2,
            $adminRole,
            $userRole
        ]);
        
    }
}
