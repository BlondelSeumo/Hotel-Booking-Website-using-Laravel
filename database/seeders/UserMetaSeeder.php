<?php

namespace Database\Seeders;

use Botble\ACL\Models\User;
use Botble\Base\Facades\MetaBox;
use Illuminate\Database\Seeder;

class UserMetaSeeder extends Seeder
{
    public function run(): void
    {
        $metadata = [
            [
                'display_name' => 'Rosalina William',
                'bio' => '🖋️ Dedicated blog writer 📚 | Crafting engaging content through the art of words. 🌍 Passionate about exploring diverse topics and sharing insightful perspectives. 🚀 Turning ideas into captivating stories. ☕ Coffee addict and creativity enthusiast. 🎨 Let’s embark on a journey of discovery through the magic of writing!',
                'facebook' => 'https://www.facebook.com',
                'twitter' => 'https://twitter.com',
                'instagram' => 'https://www.instagram.com',
                'behance' => 'https://www.behance.net',
                'linkedin' => 'https://www.linkedin.com',
            ],
        ];

        foreach ($metadata as $index => $data) {
            $user = User::query()->skip($index)->first();

            if (! $user) {
                continue;
            }

            foreach ($data as $key => $value) {
                MetaBox::saveMetaBoxData($user, $key, $value);
            }
        }
    }
}
