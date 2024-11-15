<?php

namespace Database\Seeders;

use Botble\Base\Supports\BaseSeeder;
use Botble\Hotel\Models\Amenity;
use Botble\Hotel\Models\Booking;
use Botble\Hotel\Models\BookingAddress;
use Botble\Hotel\Models\BookingRoom;
use Botble\Hotel\Models\Room;
use Botble\Hotel\Models\RoomCategory;
use Botble\Slug\Facades\SlugHelper;
use Botble\Slug\Models\Slug;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class RoomSeeder extends BaseSeeder
{
    public function run(): void
    {
        $this->uploadFiles('rooms');

        Room::query()->truncate();

        $rooms = [
            [
                'name' => 'Luxury Hall Of Fame',
                'room_category_id' => RoomCategory::query()->value('id'),
                'images' => json_encode([
                    'rooms/01.jpg',
                    'rooms/02.jpg',
                    'rooms/03.jpg',
                    'rooms/04.jpg',
                    'rooms/05.jpg',
                    'rooms/06.jpg',
                ]),
                'price' => rand(100, 200),
                'number_of_rooms' => rand(1, 10),
                'number_of_beds' => rand(1, 4),
                'max_adults' => rand(2, 6),
                'max_children' => rand(1, 3),
                'size' => rand(100, 200),
                'description' => 'Our spacious room offers a cozy ambiance, modern amenities, and stunning city views.',
            ],
            [
                'name' => 'Pendora Fame',
                'room_category_id' => RoomCategory::query()->value('id'),
                'images' => json_encode([
                    'rooms/02.jpg',
                    'rooms/01.jpg',
                    'rooms/03.jpg',
                    'rooms/04.jpg',
                    'rooms/05.jpg',
                    'rooms/06.jpg',
                ]),
                'price' => rand(100, 200),
                'number_of_rooms' => rand(1, 10),
                'number_of_beds' => rand(1, 4),
                'max_adults' => rand(2, 6),
                'max_children' => rand(1, 3),
                'size' => rand(100, 200),
                'description' => 'Indulge in comfort with plush furnishings, a private balcony, and personalized service.',
            ],
            [
                'name' => 'Pacific Room',
                'room_category_id' => RoomCategory::query()->value('id'),
                'images' => json_encode([
                    'rooms/03.jpg',
                    'rooms/02.jpg',
                    'rooms/01.jpg',
                    'rooms/04.jpg',
                    'rooms/05.jpg',
                    'rooms/06.jpg',
                ]),
                'price' => rand(100, 200),
                'number_of_rooms' => rand(1, 10),
                'number_of_beds' => rand(1, 4),
                'max_adults' => rand(2, 6),
                'max_children' => rand(1, 3),
                'size' => rand(100, 200),
                'description' => 'Unwind in style amid soothing decor, a king-sized bed, and a rejuvenating rain shower.',
            ],
            [
                'name' => 'Junior Suite',
                'room_category_id' => RoomCategory::query()->value('id'),
                'images' => json_encode([
                    'rooms/04.jpg',
                    'rooms/02.jpg',
                    'rooms/01.jpg',
                    'rooms/04.jpg',
                    'rooms/05.jpg',
                    'rooms/06.jpg',
                ]),
                'price' => rand(100, 200),
                'number_of_rooms' => rand(1, 10),
                'number_of_beds' => rand(1, 4),
                'max_adults' => rand(2, 6),
                'max_children' => rand(1, 3),
                'size' => rand(100, 200),
                'description' => 'Experience coastal charm in a room that overlooks the beach, complete with beach-inspired decor.',
            ],
            [
                'name' => 'Family Suite',
                'room_category_id' => RoomCategory::query()->value('id'),
                'images' => json_encode(['rooms/05.jpg']),
                'price' => rand(100, 200),
                'number_of_rooms' => rand(1, 10),
                'number_of_beds' => rand(1, 4),
                'max_adults' => rand(2, 6),
                'max_children' => rand(1, 3),
                'size' => rand(100, 200),
                'description' => 'Enjoy city living at its finest with contemporary design, high-end comforts, and easy access to attractions.',
            ],
            [
                'name' => 'Relax Suite',
                'room_category_id' => RoomCategory::query()->inRandomOrder()->value('id'),
                'images' => json_encode([
                    'rooms/06.jpg',
                    'rooms/02.jpg',
                    'rooms/03.jpg',
                    'rooms/04.jpg',
                    'rooms/05.jpg',
                    'rooms/01.jpg',
                ]),
                'price' => rand(100, 200),
                'number_of_rooms' => rand(1, 10),
                'number_of_beds' => rand(1, 4),
                'max_adults' => rand(2, 6),
                'max_children' => rand(1, 3),
                'size' => rand(100, 200),
                'description' => 'A rustic escape featuring wooden accents, a fireplace, and large windows for panoramic views.',
            ],
            [
                'name' => 'Luxury Suite',
                'room_category_id' => RoomCategory::query()->inRandomOrder()->value('id'),
                'images' => json_encode([
                    'rooms/01.jpg',
                    'rooms/02.jpg',
                    'rooms/03.jpg',
                    'rooms/04.jpg',
                    'rooms/05.jpg',
                    'rooms/06.jpg',
                ]),
                'price' => rand(100, 200),
                'number_of_rooms' => rand(1, 10),
                'number_of_beds' => rand(1, 4),
                'max_adults' => rand(2, 6),
                'max_children' => rand(1, 3),
                'size' => rand(100, 200),
                'description' => 'Ideal for families, this room boasts interconnected spaces, playful decor, and modern conveniences.',
            ],
            [
                'name' => 'President Room',
                'room_category_id' => RoomCategory::query()->inRandomOrder()->value('id'),
                'images' => json_encode([
                    'rooms/02.jpg',
                    'rooms/01.jpg',
                    'rooms/03.jpg',
                    'rooms/04.jpg',
                    'rooms/05.jpg',
                    'rooms/06.jpg',
                ]),
                'price' => rand(100, 200),
                'number_of_rooms' => rand(1, 10),
                'number_of_beds' => rand(1, 4),
                'max_adults' => rand(2, 6),
                'max_children' => rand(1, 3),
                'size' => rand(100, 200),
                'description' => 'Ignite romance with a room designed for couples, featuring a four-poster bed and intimate lighting.',
            ],
        ];

        Booking::query()->truncate();
        BookingAddress::query()->truncate();
        BookingRoom::query()->truncate();
        DB::table('ht_booking_services')->truncate();

        $amenities = Amenity::query()->pluck('id')->all();
        $faker = $this->fake();
        foreach ($rooms as $room) {
            $room['tax_id'] = 1;
            $room['is_featured'] = rand(0, 1);
            $room['content'] = File::get(database_path('seeders/contents/room-content.html'));
            $room = Room::query()->create($room);

            if ($countAmenities = count($amenities)) {
                $amenitiesRandom = [];
                foreach ($faker->randomElements(range(1, $countAmenities), rand(5, $countAmenities)) as $i) {
                    $amenitiesRandom[] = $i;
                }

                $room->amenities()->sync($amenitiesRandom);
            }

            Slug::query()->create([
                'reference_type' => Room::class,
                'reference_id' => $room->id,
                'key' => Str::slug($room->name),
                'prefix' => SlugHelper::getPrefix(Room::class),
            ]);
        }
    }
}
