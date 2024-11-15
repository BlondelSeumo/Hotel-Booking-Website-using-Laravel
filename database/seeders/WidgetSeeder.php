<?php

namespace Database\Seeders;

use Botble\Base\Supports\BaseSeeder;
use Botble\Theme\Facades\Theme;
use Botble\Widget\Models\Widget as WidgetModel;

class WidgetSeeder extends BaseSeeder
{
    public function run(): void
    {
        WidgetModel::query()->truncate();

        $data = [
            [
                'widget_id' => 'ContactInformationMenuWidget',
                'sidebar_id' => 'footer_sidebar',
                'position' => 0,
                'data' => [
                    'phone_number' => '1800-121-3637',
                    'email' => 'info@example.com',
                    'address' => "1247/Plot No. 39, 15th Phase,\nLHB Colony, Kanpur",
                ],
            ],
            [
                'widget_id' => 'CustomMenuWidget',
                'sidebar_id' => 'footer_sidebar',
                'position' => 1,
                'data' => [
                    'id' => 'CustomMenuWidget',
                    'name' => 'Our Links',
                    'menu_id' => 'our-links',
                ],
            ],
            [
                'widget_id' => 'CustomMenuWidget',
                'sidebar_id' => 'footer_sidebar',
                'position' => 2,
                'data' => [
                    'id' => 'CustomMenuWidget',
                    'name' => 'Our Services',
                    'menu_id' => 'our-services',
                ],
            ],
            [
                'widget_id' => 'NewsletterWidget',
                'sidebar_id' => 'footer_sidebar',
                'position' => 3,
                'data' => [
                    'id' => 'NewsletterWidget',
                    'title' => __('Subscribe To Our Newsletter'),
                ],
            ],
            [
                'widget_id' => 'BlogSearchWidget',
                'sidebar_id' => 'blog_sidebar',
                'position' => 1,
                'data' => [
                    'id' => 'BlogSearchWidget',
                    'name' => 'Blog Search',
                ],
            ],
            [
                'widget_id' => 'BlogSocialsWidget',
                'sidebar_id' => 'blog_sidebar',
                'position' => 2,
                'data' => [
                    'id' => 'BlogSocialsWidget',
                    'name' => 'Blog Socials',
                ],
            ],
            [
                'widget_id' => 'BlogCategoriesWidget',
                'sidebar_id' => 'blog_sidebar',
                'position' => 3,
                'data' => [
                    'id' => 'BlogCategoriesWidget',
                    'name' => 'Blog Categories',
                ],
            ],
            [
                'widget_id' => 'BlogPostsWidget',
                'sidebar_id' => 'blog_sidebar',
                'position' => 4,
                'data' => [
                    'id' => 'BlogPostsWidget',
                    'name' => 'Blog Posts',
                    'type' => 'recent',
                    'limit' => 5,
                ],
            ],
            [
                'widget_id' => 'BlogTagsWidget',
                'sidebar_id' => 'blog_sidebar',
                'position' => 5,
                'data' => [
                    'id' => 'BlogTagsWidget',
                    'name' => 'Blog Tags',
                ],
            ],
            [
                'widget_id' => 'RoomContactWidget',
                'sidebar_id' => 'room_sidebar',
                'position' => 0,
                'data' => [
                    'id' => 'RoomContactWidget',
                    'title' => __('If You Need Any Help Contact Us'),
                    'phone' => '917052101786',
                ],
            ],
            [
                'widget_id' => 'RoomContactWidget',
                'sidebar_id' => 'service_sidebar',
                'position' => 0,
                'data' => [
                    'id' => 'RoomContactWidget',
                    'title' => __('If You Need Any Help Contact Us'),
                    'phone' => '917052101786',
                ],
            ],
            [
                'widget_id' => 'CheckAvailabilityForm',
                'sidebar_id' => 'rooms_sidebar',
                'position' => 0,
                'data' => [
                    'title' => __('Booking form'),
                    'id' => 'CheckAvailabilityForm',
                ],
            ],
        ];

        $theme = Theme::getThemeName();

        foreach ($data as $item) {
            $item['theme'] = $theme;
            WidgetModel::query()->create($item);
        }
    }
}
