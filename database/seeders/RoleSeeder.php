<?php

namespace Database\Seeders;

use App\Enums\PermissionEnum;
use App\Enums\RoleEnum;
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
        $adminRole = Role::create(['name' => RoleEnum::ADMIN]);
        $updateOrder = Permission::create(['name' => PermissionEnum::UPDATE_ORDER]);
        $userRole = Role::create(['name' => RoleEnum::USER]);
        $viewOrder = Permission::create(['name' => PermissionEnum::VIEW_ORDER]);
        $createOrder = Permission::create(['name' => PermissionEnum::CREATE_ORDER]);

        $adminRole->givePermissionTo($updateOrder);
        $userRole->givePermissionTo([$viewOrder, $createOrder]);
    }
}
