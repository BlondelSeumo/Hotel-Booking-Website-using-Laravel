<?php

namespace Database\Seeders;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Facades\Html;
use Botble\Base\Supports\BaseSeeder;
use Botble\Slug\Facades\SlugHelper;
use Botble\Slug\Models\Slug;
use Botble\Team\Models\Team;
use Illuminate\Support\Str;

class TeamSeeder extends BaseSeeder
{
    public function run(): void
    {
        $this->uploadFiles('teams');

        $teams = [
            [
                'name' => 'Howard Holmes',
                'title' => 'General Manager',
                'location' => 'USA',
                'phone' => '12345678',
                'address' => 'Cecilia Chapman711-2880 Nulla St.',
                'email' => 'howard@gmail.com',
                'website' => 'https://example.com',
            ],
            [
                'name' => 'Ella Thompson',
                'title' => 'Bell Captain',
                'location' => 'Qatar',
                'phone' => '234324232',
                'address' => 'Cecilia Chapman711-2880 Nulla St.',
                'email' => 'thompson@gmail.com',
                'website' => 'https://example.com',
            ],
            [
                'name' => 'Devon Lane',
                'title' => 'Executive Chef',
                'location' => 'India',
                'phone' => '543324322',
                'address' => 'Cecilia Chapman711-2880 Nulla St.',
                'email' => 'devon@gmail.com',
                'website' => 'https://example.com',
            ],
            [
                'name' => 'Kate Beckham',
                'title' => 'Bartender',
                'location' => 'Thailand',
                'phone' => '234345432',
                'address' => 'Cecilia Chapman711-2880 Nulla St.',
                'email' => 'beckham@gmail.com',
                'website' => 'https://example.com',
            ],
            [
                'name' => 'Vincent Cooper',
                'title' => 'Driver',
                'location' => 'Poland',
                'phone' => '4324234221',
                'address' => 'Cecilia Chapman711-2880 Nulla St.',
                'email' => 'cooper@gmail.com',
                'website' => 'https://example.com',
            ],
            [
                'name' => 'Danielle Bryant',
                'title' => 'Event Coordinator',
                'location' => 'Finland',
                'phone' => '4234232321',
                'address' => 'Cecilia Chapman711-2880 Nulla St.',
                'email' => 'danielle@gmail.com',
                'website' => 'https://example.com',
            ],
            [
                'name' => 'Kami Hope',
                'title' => 'Event Coordinator',
                'location' => 'Thailand',
                'phone' => '123456781',
                'address' => 'Cecilia Chapman711-2880 Bangkok St.',
                'email' => 'hope@gmail.com',
                'website' => 'https://example.com',
            ],
            [
                'name' => 'Frankie Musk',
                'title' => 'Driver',
                'location' => 'USA',
                'phone' => '1323243242',
                'address' => 'Cecilia Chapman711-2880 Nulla St.',
                'email' => 'frankie@gmail.com',
                'website' => 'https://example.com',
            ],
        ];

        $content =
            Html::tag('p', 'Pleasure and praising pain was born and I will give you a complete account of the systems, and expound the actually teachings of the great explorer of the truth, the master-builder of human uts happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally Nor who loves or pursues or desires to obtain pain of itself.') .
            Html::tag('p', 'Tempor nonummy metus lobortis. Sociis velit etiam, dapibus lectus vehicula pele llentesque cras pat fusce pharetra felis sapien varius Integer dis ads se purus sollicitudin dapibus et vivamus pharetra sit integer dictum in dise natoque an mus quis in. Facilisis inceptos nec, potenti nostra aenean lacinia varius semper ant nullam nulla primis placerat facilisis. Netus lorem rutrum arcu dignissim at sit morbi phasellus nascetur eget urna potenti cum vestibulum cras.') .
            Html::tag('div', '[user-profile image_1="teams/img1.png" image_2="teams/img2.png" quantity="3" title_1="Design" percentage_1="80" title_2="Easy Manage" percentage_2="90" title_3="Project Organize" percentage_3="70"][/user-profile]');

        Team::query()->truncate();

        foreach ($teams as $index => $item) {
            $item['photo'] = 'teams/' . ($index + 1) . '.png';
            $item['socials'] = [
                'facebook' => 'https://www.facebook.com/',
                'twitter' => 'https://twitter.com/',
                'instagram' => 'https://www.instagram.com/',
            ];
            $item['content'] = $content;

            $item['status'] = BaseStatusEnum::PUBLISHED;

            $team = Team::query()->create($item);

            Slug::query()->create([
                'reference_type' => Team::class,
                'reference_id' => $team->id,
                'key' => Str::slug($team->name),
                'prefix' => SlugHelper::getPrefix(Team::class),
            ]);
        }
    }
}
