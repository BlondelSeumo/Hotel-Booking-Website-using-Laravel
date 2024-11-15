<?php

namespace Database\Seeders;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Supports\BaseSeeder;
use Botble\Hotel\Models\Service;
use Botble\Media\Facades\RvMedia;
use Botble\Slug\Facades\SlugHelper;
use Botble\Slug\Models\Slug;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ServiceSeeder extends BaseSeeder
{
    public function run(): void
    {
        Service::query()->truncate();

        $services = [
            [
                'name' => 'Quality Room',
                'image' => 'amenities/icon-1.png',
                'price' => 100,
                'description' => 'Indulge in the epitome of comfort and style with our Quality Room. Immerse yourself in elegant furnishings, unwind in a plush bed, and enjoy modern amenities. From the private ensuite bathroom to the high-speed Wi-Fi, every detail is designed for your relaxation. Choose between city, garden, or pool views, and experience a retreat that embodies luxury and convenience.',
            ],
            [
                'name' => 'Privet Beach',
                'image' => 'amenities/icon-2.png',
                'price' => 30,
                'description' => 'Discover a world of exclusivity with our Private Beach Access service. Step onto a pristine shore reserved for our guests, where sun, sand, and waves meet ultimate tranquility. Lounge in comfortable beachside seating, enjoy dedicated service, and bask in the beauty of a secluded paradise.',
            ],
            [
                'name' => 'Best Accommodation',
                'image' => 'amenities/icon-3.png',
                'price' => 50,
                'description' => 'Experience the pinnacle of luxury with our Best Accommodation service. Immerse yourself in meticulously designed spaces that combine opulence and comfort. From elegant furnishings to cutting-edge amenities, every detail is curated to exceed your expectations.',
            ],
            [
                'name' => 'Wellness & Spa',
                'image' => 'amenities/icon-4.png',
                'price' => 10,
                'description' => 'Embark on a journey of rejuvenation and self-care with our Wellness & Spa service. Immerse yourself in a sanctuary of relaxation, where skilled therapists pamper you with a range of invigorating treatments.',
            ],
            [
                'name' => 'Restaurants & Bars',
                'image' => 'amenities/icon-5.png',
                'price' => 10,
                'description' => 'Savor a world of flavors at our Restaurants & Bars. Indulge in culinary delights crafted by talented chefs, offering a diverse range of cuisines to tantalize your taste buds. From elegant dining to vibrant social hubs, our venues provide a gastronomic journey paired with a selection of beverages that cater to every palate. .',
            ],
            [
                'name' => 'Special Offers',
                'image' => 'amenities/icon-6.png',
                'price' => 10,
                'description' => 'Unlock unbeatable value with our Special Offers. Experience the luxury of Hotel at exceptional rates, whether you\'re planning a romantic getaway, a family vacation, or a business retreat. Our exclusive packages cater to every traveler\'s needs, providing an unforgettable stay enriched with added perks.',
            ],
        ];

        $content = str_replace(
            'general/',
            RvMedia::getImageUrl('general/'),
            File::get(database_path('seeders/contents/service-content.html')),
        );

        foreach ($services as $service) {
            $service['content'] = $content;
            $service['status'] = BaseStatusEnum::PUBLISHED;
            $service = Service::query()->create($service);

            Slug::query()->create([
                'reference_type' => Service::class,
                'reference_id' => $service->id,
                'key' => Str::slug($service->name),
                'prefix' => SlugHelper::getPrefix(Service::class),
            ]);
        }
    }
}
