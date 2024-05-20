<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@pizzamagic.com',
        ]);

        $admin->assignRole(RoleEnum::ADMIN->value);

        $user = User::factory()->create([
            'name' => 'Customer One',
            'email' => 'one@customer.com',
        ]);

        $user->assignRole(RoleEnum::USER->value);
    }
}
