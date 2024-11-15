<?php

namespace Database\Seeders;

use Botble\Base\Supports\BaseSeeder;
use Botble\Gallery\Models\Gallery as GalleryModel;
use Botble\Gallery\Models\GalleryMeta;
use Botble\Slug\Facades\SlugHelper;
use Botble\Slug\Models\Slug;
use Illuminate\Support\Str;

class GallerySeeder extends BaseSeeder
{
    public function run(): void
    {
        $this->uploadFiles('galleries');

        GalleryModel::query()->truncate();
        GalleryMeta::query()->truncate();

        $galleries = [
            [
                'name' => 'Room',
                'description' => 'Immerse yourself in the epitome of comfort and luxury within our meticulously designed rooms. Each space is a sanctuary where sophistication meets functionality. From plush furnishings to panoramic views, every detail is crafted to ensure an unparalleled stay that leaves a lasting impression.',
            ],
            [
                'name' => 'Hall',
                'description' => 'Our event halls are more than spaces; they’re canvases for your imagination. With timeless design and versatile layouts, they’re perfect for weddings, conferences, and gatherings of all kinds. Equipped with state-of-the-art technology and impeccable service, our halls set the stage for unforgettable moments.',
            ],
            [
                'name' => 'Guardian',
                'description' => 'Our vigilant team takes your safety and comfort seriously. With unwavering dedication, our guardians ensure every corner of our hotel is secure, clean, and welcoming. From discreet housekeeping to attentive concierge services, their commitment ensures you experience nothing but the finest in hospitality. Your peace of mind is their top priority',
            ],
            [
                'name' => 'Hotel',
                'description' => 'Experience opulence redefined at Riorelax. Our meticulously designed rooms and suites offer breathtaking views, plush amenities, and a haven of tranquility. Immerse yourself in sumptuous comfort that sets the stage for an unforgettable stay.',
            ],
            [
                'name' => 'Event Hall',
                'description' => 'Celebrate life’s milestones in style with our exceptional event spaces. From weddings to corporate gatherings, our dedicated team crafts experiences that leave a lasting impression. Impeccable service, state-of-the-art facilities, and a picturesque backdrop ensure your event is nothing short of extraordinary.',
            ],
        ];

        $images = collect();
        for ($i = 0; $i < 10; $i++) {
            $images->push([
                'img' => sprintf('galleries/%d.png', $i + 1),
                'description' => $this->fake()->text(150),
            ]);
        }

        foreach ($galleries as $index => $item) {
            $item['image'] = sprintf('galleries/%d.png', $index + 1);
            $item['user_id'] = 1;
            $item['is_featured'] = true;

            $gallery = GalleryModel::query()->create($item);

            Slug::query()->create([
                'reference_type' => GalleryModel::class,
                'reference_id' => $gallery->getKey(),
                'key' => Str::slug($gallery->name),
                'prefix' => SlugHelper::getPrefix(GalleryModel::class),
            ]);

            GalleryMeta::query()->create([
                'images' => $images->shuffle()->toArray(),
                'reference_id' => $gallery->getKey(),
                'reference_type' => GalleryModel::class,
            ]);
        }
    }
}
