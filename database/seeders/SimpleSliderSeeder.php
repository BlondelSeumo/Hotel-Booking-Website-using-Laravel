<?php

namespace Database\Seeders;

use Botble\Base\Facades\MetaBox;
use Botble\Base\Supports\BaseSeeder;
use Botble\Language\Models\LanguageMeta;
use Botble\Setting\Facades\Setting;
use Botble\SimpleSlider\Models\SimpleSlider;
use Botble\SimpleSlider\Models\SimpleSliderItem;
use Illuminate\Support\Arr;

class SimpleSliderSeeder extends BaseSeeder
{
    public function run(): void
    {
        $this->uploadFiles('banners');

        SimpleSlider::query()->truncate();
        SimpleSliderItem::query()->truncate();

        $sliders = [
            [
                'name' => 'Home slider',
                'key' => 'home-slider',
                'description' => 'The main slider on homepage',
            ],
        ];

        $sliderItems = [
            [
                'title' => 'Enjoy A Luxury Experience',
                'description' => 'Donec vitae libero non enim placerat eleifend aliquam erat volutpat. Curabitur diam ex, dapibus purus sapien, cursus sed nisl tristique, commodo gravida lectus non.',
            ],
            [
                'title' => 'Enjoy A Luxury Experience',
                'description' => 'Donec vitae libero non enim placerat eleifend aliquam erat volutpat. Curabitur diam ex, dapibus purus sapien, cursus sed nisl tristique, commodo gravida lectus non.',
            ],
        ];

        foreach ($sliders as $value) {
            $slider = SimpleSlider::query()->create($value);

            LanguageMeta::saveMetaData($slider);

            foreach ($sliderItems as $key => $item) {
                $key++;

                $sliderItem = SimpleSliderItem::query()->create(array_merge(Arr::except($item, 'subtitle'), [
                    'simple_slider_id' => $slider->getKey(),
                    'link' => '/contact-us',
                    'image' => sprintf('banners/slider-%d.png', $key),
                    'order' => $key,
                ]));

                MetaBox::saveMetaBoxData($sliderItem, 'button_primary_label', __('Discover More '));
                MetaBox::saveMetaBoxData($sliderItem, 'button_primary_url', '/contact-us');
                MetaBox::saveMetaBoxData($sliderItem, 'button_play_label', __('Intro video'));
                MetaBox::saveMetaBoxData($sliderItem, 'youtube_url', __('https://www.youtube.com/watch?v=v2qeqkKgw7U'));
            }
        }

        Setting::set('simple_slider_using_assets', false)->save();
    }
}
