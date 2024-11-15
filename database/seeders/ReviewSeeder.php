<?php

namespace Database\Seeders;

use Botble\Hotel\Models\Customer;
use Botble\Hotel\Models\Review;
use Botble\Hotel\Models\Room;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        Review::query()->truncate();

        $customersCount = Customer::query()->count();
        $roomsCount = Room::query()->count();

        $faker = fake();

        $now = Carbon::now();

        $contents = [
            'An incredible stay! The room was spacious and beautifully decorated. The amenities provided made me feel right at home. I can’t wait to come back.',
            'Absolutely loved my experience here! The room was not only clean and comfortable but also offered stunning views of the surrounding area. A perfect choice for a relaxing getaway.',
            'I was thoroughly impressed with the attention to detail in the room. Everything from the cozy bed to the modern bathroom exceeded my expectations. Highly recommend!',
            'Top-notch accommodations! The room was well-appointed and had all the necessary amenities. The staff was incredibly friendly and made my stay even more enjoyable.',
            'A hidden gem! The room was a haven of tranquility, providing a peaceful escape from the bustling city. I appreciated the little touches that made my stay truly special.',
            'I couldn’t have asked for a better place to stay. The room’s design was elegant, and the comfort level was off the charts. Staying here added a layer of luxury to my trip.',
            'Exceeded all my hopes! The room was not only comfortable but also surprisingly spacious. I loved the attention to cleanliness and the warm, inviting atmosphere.',
            'Five-star experience all the way. The room was meticulously maintained, and the staff was incredibly helpful throughout my stay. I’m already planning my next visit.',
        ];

        foreach (range(1, 50) as $ignored) {
            Review::query()->insertOrIgnore([
                'customer_id' => rand(1, $customersCount),
                'room_id' => rand(1, $roomsCount),
                'content' => $faker->randomElement($contents),
                'star' => rand(4, 5),
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
