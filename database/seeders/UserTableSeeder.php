<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i < 50 ; $i++) { 
            $user = User::create([
                'name' => 'Test'.$i,
                'email' => 'Test'.$i.'@test.com',
                'is_admin' => 0,
                'email_verified_at' => now(),
                'password' => Hash::make('rainnda11'),
                'remember_token' => Str::random(10),
            ]);

            $role = Role::where('id',5)->first();
            $user->syncRoles($role);

             
        }
    }
}
