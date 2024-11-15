<?php

namespace Database\Seeders;

use Botble\Base\Supports\BaseSeeder;
use Botble\Hotel\Models\Place;
use Botble\Media\Facades\RvMedia;
use Botble\Slug\Facades\SlugHelper;
use Botble\Slug\Models\Slug;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PlaceSeeder extends BaseSeeder
{
    public function run(): void
    {
        $this->uploadFiles('places');

        Place::query()->truncate();

        $places = [
            [
                'name' => 'Duplex Restaurant',
                'distance' => '1,500m | 21 min. Walk',
                'image' => 'places/01.jpg',
            ],
            [
                'name' => 'Overnight Bars',
                'distance' => '1,500m | 21 min. Walk',
                'image' => 'places/02.jpg',
            ],
            [
                'name' => 'Beautiful Beach',
                'distance' => '1,500m | 21 min. Walk',
                'image' => 'places/03.jpg',
            ],
            [
                'name' => 'Beautiful Spa',
                'distance' => '1,500m | 21 min. Walk',
                'image' => 'places/04.jpg',
            ],
            [
                'name' => 'Duplex Golf',
                'distance' => '1,500m | 21 min. Walk',
                'image' => 'places/05.jpg',
            ],
            [
                'name' => 'Luxury Restaurant',
                'distance' => '1,500m | 21 min. Walk',
                'image' => 'places/06.jpg',
            ],
        ];

        $content = str_replace(
            'places/',
            RvMedia::getImageUrl('places/'),
            File::get(database_path('seeders/contents/place-content.html')),
        );

        foreach ($places as $place) {
            $place['content'] = $content;
            $place = Place::query()->create($place);

            Slug::query()->create([
                'reference_type' => Place::class,
                'reference_id' => $place->id,
                'key' => Str::slug($place->name),
                'prefix' => SlugHelper::getPrefix(Place::class),
            ]);
        }
    }
}
