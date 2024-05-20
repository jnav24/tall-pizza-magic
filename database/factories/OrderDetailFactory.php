<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class OrderDetailFactory extends Factory
{
    protected $model = OrderDetail::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'quantity' => $this->faker->randomNumber(),
            'menu_item_id' => $this->faker->randomNumber(),
            'price' => $this->faker->randomFloat(),

            'order_id' => Order::factory(),
        ];
    }
}
