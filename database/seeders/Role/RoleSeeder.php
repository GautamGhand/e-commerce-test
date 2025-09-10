<?php

namespace Database\Seeders\Role;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role_admin = Role::create([
            'name' => 'admin'
        ]);

        $role_customer = Role::create([
            'name' => 'customer'
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'admin@example.com',
            'role_id' => $role_admin->id,
            'password' => Hash::make('123456')
        ]);

        User::factory()->create([
            'name' => 'Customer User',
            'email' => 'customer@example.com',
            'role_id' => $role_customer->id,
            'password' => Hash::make('123456')
        ]);
    }
}
