<?php

namespace Database\Factories;

use App\Models\MenuItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class MenuItemFactory extends Factory
{
    protected $model = MenuItem::class;

    public function definition(): array
    {
        return [
            'price' => $this->faker->randomFloat(),
            'name' => $this->faker->name(),
            'ingredients' => $this->faker->word(),
            'description' => $this->faker->text(),
            'img_url' => $this->faker->imageUrl(),
        ];
    }
}
