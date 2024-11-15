<?php

use Illuminate\Database\Migrations\Migration;
use Botble\Setting\Models\Setting as SettingModel;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $socialLinks = [
            [
                [
                    'key'   => 'social-name',
                    'value' => 'Facebook',
                ],
                [
                    'key'   => 'social-icon',
                    'value' => 'fab fa-facebook-f',
                ],
                [
                    'key'   => 'social-url',
                    'value' => theme_option('facebook'),
                ],
            ],
            [
                [
                    'key'   => 'social-name',
                    'value' => 'Twitter',
                ],
                [
                    'key'   => 'social-icon',
                    'value' => 'fab fa-twitter',
                ],
                [
                    'key'   => 'social-url',
                    'value' => theme_option('twitter'),
                ],
            ],
            [
                [
                    'key'   => 'social-name',
                    'value' => 'Youtube',
                ],
                [
                    'key'   => 'social-icon',
                    'value' => 'fab fa-youtube',
                ],
                [
                    'key'   => 'social-url',
                    'value' => theme_option('youtube'),
                ],
            ],
            [
                [
                    'key'   => 'social-name',
                    'value' => 'Behance',
                ],
                [
                    'key'   => 'social-icon',
                    'value' => 'fab fa-behance',
                ],
                [
                    'key'   => 'social-url',
                    'value' => theme_option('behance'),
                ],
            ],
            [
                [
                    'key'   => 'social-name',
                    'value' => 'Linkedin',
                ],
                [
                    'key'   => 'social-icon',
                    'value' => 'fab fa-linkedin',
                ],
                [
                    'key'   => 'social-url',
                    'value' => theme_option('linkedin'),
                ],
            ],
        ];

        SettingModel::insertOrIgnore([
            'key'   => 'theme-' . Theme::getThemeName() . '-social_links',
            'value' => json_encode($socialLinks),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
