<?php

namespace Database\Seeders;

use Botble\Base\Facades\MetaBox;
use Botble\Base\Supports\BaseSeeder;
use Botble\Hotel\Models\Amenity;

class AmenitySeeder extends BaseSeeder
{
    public function run(): void
    {
        $this->uploadFiles('amenities');

        Amenity::query()->truncate();

        $amenities = [
            [
                'name' => 'Air conditioner',
                'icon' => 'fal fa-bath',
            ],
            [
                'name' => 'High speed WiFi',
                'icon' => 'fal fa-wifi',
            ],
            [
                'name' => 'Strong Locker',
                'icon' => 'fal fa-key',
            ],
            [
                'name' => 'Breakfast',
                'icon' => 'fal fa-cut',
            ],
            [
                'name' => 'Kitchen',
                'icon' => 'fal fa-guitar',
            ],
            [
                'name' => 'Smart Security',
                'icon' => 'fal fa-lock',
            ],
            [
                'name' => 'Cleaning',
                'icon' => 'fal fa-broom',
            ],
            [
                'name' => 'Shower',
                'icon' => 'fal fa-shower',
            ],
            [
                'name' => '24/7 Online Support',
                'icon' => 'fal fa-headphones-alt',
            ],
            [
                'name' => 'Grocery',
                'icon' => 'fal fa-shopping-basket',
            ],
            [
                'name' => 'Single bed',
                'icon' => 'fal fa-bed',
            ],
            [
                'name' => 'Expert Team',
                'icon' => 'fal fa-users',
            ],
            [
                'name' => 'Shop near',
                'icon' => 'fal fa-shopping-cart',
            ],
            [
                'name' => 'Towels',
                'icon' => 'fal fa-bus',
            ],
        ];

        $faker = $this->fake();

        foreach ($amenities as $amenity) {
            $newAmenity = Amenity::query()->create($amenity);

            MetaBox::saveMetaBoxData($newAmenity, 'icon_image', sprintf('amenities/icon-%s.png', rand(1, 6)));
            MetaBox::saveMetaBoxData($newAmenity, 'description', $faker->text(120));
        }
    }
}
