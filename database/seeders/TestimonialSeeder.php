<?php

namespace Database\Seeders;

use Botble\Base\Supports\BaseSeeder;
use Botble\Language\Models\LanguageMeta;
use Botble\Testimonial\Models\Testimonial;

class TestimonialSeeder extends BaseSeeder
{
    public function run(): void
    {
        $this->uploadFiles('testimonials');

        $data = [
            [
                'name' => 'Adam Williams',
                'company' => 'CEO Of Microsoft',
                'content' => 'A true gem! Impeccable service, stunning views, and utmost comfort. Our stay was pure perfection. Planning our return!',
            ],
            [
                'name' => 'Retha Deowalim',
                'company' => 'CEO Of Apple',
                'content' => 'Exceeded expectations in every way. Elegant rooms, delectable dining. Our stay was pure perfection. 5 stars!"',
            ],
            [
                'name' => 'Sam J. Wasim',
                'company' => 'Pio Founder',
                'content' => 'Paradise found. Serene ambiance, exceptional amenities, and warm hospitality. Already planning our return!',
            ],
            [
                'name' => 'Daniel Rodriguez',
                'company' => 'VP Of Google',
                'content' => 'An exceptional experience from start to finish. The attention to detail, combined with breathtaking surroundings.',
            ],
            [
                'name' => 'Daniel Chang',
                'company' => 'Founder Of SpaceX',
                'content' => 'A true haven for relaxation. Every aspect of our stay, from the luxurious rooms to the exquisite dining, was exceptional.',
            ],
            [
                'name' => 'Isabella Russo',
                'company' => 'Fashion Designer',
                'content' => 'Indulgence at its finest. The blend of modern luxury and natural beauty exceeded our expectations, was exceptional.',
            ],
        ];

        Testimonial::query()->truncate();
        $faker = $this->fake();
        foreach ($data as $index => $item) {
            $item['image'] = 'testimonials/0' . ($index + 1) . '.png';

            $testimonial = Testimonial::query()->create($item);

            LanguageMeta::saveMetaData($testimonial);
        }
    }
}
