<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'uuid' => $this->faker->uuid(),
            'status_id' => $this->faker->randomNumber(),
            'order_detail_id' => $this->faker->randomNumber(),

            'user_id' => User::factory(),
        ];
    }
}
