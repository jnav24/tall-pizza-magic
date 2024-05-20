<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MenuItem::factory()->create([
            'price' => '9.99',
            'name' => 'Cheese Pizza',
            'ingredients' => '',
            'description' => '',
            'img_url' => 'https://i.ytimg.com/vi/3Z6TCicRLhs/sddefault.jpg',
        ]);

        MenuItem::factory()->create([
            'price' => '11.99',
            'name' => 'Pepperoni Pizza',
            'ingredients' => '',
            'description' => '',
            'img_url' => 'https://ik.imagekit.io/smithfield/armour/4353bced-f940-00d0-8c6e-13a0a4a7f5c2/2ac60829-5178-4a6e-80cf-6ca43d862cee/Quick-and-Easy-Pepperoni-Pizza-700x700.jpeg',
        ]);

        MenuItem::factory()->create([
            'price' => '11.99',
            'name' => 'Sausage Pizza',
            'ingredients' => '',
            'description' => '',
            'img_url' => 'https://www.papajohns.com/static-assets/a/images/web/product/pizzas/sausagepp-slated.jpg',
        ]);

        MenuItem::factory()->create([
            'price' => '10.99',
            'name' => 'Veggie Pizza',
            'ingredients' => '',
            'description' => '',
            'img_url' => 'https://www.simplyrecipes.com/thmb/wyfKZ6r4an5GdL19fFiAFlgr19c=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/Simply-Recipes-Vegetarian-Pizza-LEAD-5-03d81aaf35f24e5b99de36d2c29c15eb.jpg',
        ]);
    }
}
