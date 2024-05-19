<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::create(['name' => 'admin']);
        $updateOrder = Permission::create(['name' => 'update_order']);
        $userRole = Role::create(['name' => 'user']);
        $viewOrder = Permission::create(['name' => 'view_order']);
        $createOrder = Permission::create(['name' => 'create_order']);

        $adminRole->givePermissionTo($updateOrder);
        $userRole->givePermissionTo([$viewOrder, $createOrder]);
    }
}
