<?php

namespace Database\Seeders;

use Botble\Base\Supports\BaseSeeder;
use Botble\Hotel\Models\Food;

class FoodSeeder extends BaseSeeder
{
    public function run(): void
    {
        $this->uploadFiles('foods');

        Food::query()->truncate();

        $foods = [
            [
                'name' => 'Eggs & Bacon',
                'food_type_id' => 1,
                'image' => 'foods/01.jpg',
                'price' => rand(100, 200),
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vel molestie nisl. Duis ac mi leo.',
            ],
            [
                'name' => 'Tea or Coffee',
                'food_type_id' => 1,
                'image' => 'foods/02.jpg',
                'price' => rand(100, 200),
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vel molestie nisl. Duis ac mi leo.',
            ],
            [
                'name' => 'Chia Oatmeal',
                'food_type_id' => 1,
                'image' => 'foods/03.jpg',
                'price' => rand(100, 200),
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vel molestie nisl. Duis ac mi leo.',
            ],
            [
                'name' => 'Juice',
                'food_type_id' => 1,
                'image' => 'foods/04.jpg',
                'price' => rand(100, 200),
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vel molestie nisl. Duis ac mi leo.',
            ],
            [
                'name' => 'Chia Oatmeal',
                'food_type_id' => 2,
                'image' => 'foods/05.jpg',
                'price' => rand(100, 200),
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vel molestie nisl. Duis ac mi leo.',
            ],
            [
                'name' => 'Fruit Parfait',
                'food_type_id' => 2,
                'image' => 'foods/06.jpg',
                'price' => rand(100, 200),
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vel molestie nisl. Duis ac mi leo.',
            ],
            [
                'name' => 'Marmalade Selection',
                'food_type_id' => 3,
                'image' => 'foods/07.jpg',
                'price' => rand(100, 200),
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vel molestie nisl. Duis ac mi leo.',
            ],
            [
                'name' => 'Cheese Platen',
                'food_type_id' => 4,
                'image' => 'foods/08.jpg',
                'price' => rand(100, 200),
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vel molestie nisl. Duis ac mi leo.',
            ],
            [
                'name' => 'Avocado Toast',
                'food_type_id' => 5,
                'image' => 'foods/09.jpg',
                'price' => rand(100, 200),
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vel molestie nisl. Duis ac mi leo.',
            ],
            [
                'name' => 'Avocado Toast',
                'food_type_id' => 6,
                'image' => 'foods/10.jpg',
                'price' => rand(100, 200),
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vel molestie nisl. Duis ac mi leo.',
            ],
        ];

        foreach ($foods as $food) {
            Food::query()->create($food);
        }
    }
}
