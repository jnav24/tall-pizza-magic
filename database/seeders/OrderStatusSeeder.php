<?php

namespace Database\Seeders;

use App\Enums\OrderStatusEnum;
use App\Models\OrderStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OrderStatus::factory()->create(['name' => OrderStatusEnum::PENDING]);
        OrderStatus::factory()->create(['name' => OrderStatusEnum::PREPARING]);
        OrderStatus::factory()->create(['name' => OrderStatusEnum::READY]);
    }
}
