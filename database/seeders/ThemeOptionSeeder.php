<?php

namespace Database\Seeders;

use Botble\Base\Supports\BaseSeeder;
use Botble\Setting\Facades\Setting;
use Botble\Theme\Facades\ThemeOption;
use Carbon\Carbon;

class ThemeOptionSeeder extends BaseSeeder
{
    public function run(): void
    {
        $this->uploadFiles('general');

        Setting::newQuery()->where('key', 'LIKE', ThemeOption::getOptionKey('%'))->delete();

        Setting::set(ThemeOption::prepareFromArray([
            'site_title' => 'Hotel Riorelax',
            'copyright' => sprintf('©%s Archi Elite JSC. All right reserved.', Carbon::now()->year),
            'primary_color' => '#644222',
            'secondary_color' => '#be9874',
            'input_border_color' => '#d7cfc8',
            'primary_color_hover' => '#2e1913',
            'button_text_color_hover' => '#101010',
            'primary_font' => 'Roboto',
            'heading_font' => 'Jost',
            'cookie_consent_message' => 'Your experience on this site will be improved by allowing cookies ',
            'cookie_consent_learn_more_url' => '/cookie-policy',
            'cookie_consent_learn_more_text' => 'Cookie Policy',
            'homepage_id' => 1,
            'blog_page_id' => 10,
            'logo' => $this->filePath('general/logo.png'),
            'favicon' => $this->filePath('general/favicon.png'),
            'email' => 'info@webmail.com',
            'address' => '14/A, Riorelax City, NYC',
            'hotline' => '+908 987 877 09',
            'preloader_enabled' => 'no',
            'opening_hours' => 'Mon - Fri: 9:00 - 19:00/ Closed on Weekends',
            'header_button_url' => '/contact-us',
            'header_button_label' => 'Reservation',
            'background_footer' => $this->filePath('backgrounds/footer-bg.png'),
            'galleries_limit_images' => '3',
            'hotel_rules' => '<ul><li>No smoking, parties or events.</li><li>Check-in time from 2 PM, check-out by 10 AM.</li><li>Time to time car parking</li><li>Download Our minimal app</li><li>Browse regular our website</li></ul>',
            'cancellation' => '<p>We’re pleased to offer a full refund of the booking amount for cancellations made <strong>14 days or more</strong> before the scheduled check-in date. This generous window provides you with the flexibility to adjust your plans without any financial repercussions.<p>',
            'authentication_login_background_image' => $this->filePath('general/booking-img.png'),
            'authentication_register_background_image' => $this->filePath('general/booking-img.png'),
            'authentication_forgot_password_background_image' => $this->filePath('general/booking-img.png'),
            'authentication_reset_password_background_image' => $this->filePath('general/booking-img.png'),
            '404_page_image' => 'general/404.png',
            'social_links' => [
                [
                    [
                        'key' => 'name',
                        'value' => 'Facebook',
                    ],
                    [
                        'key' => 'social-icon',
                        'value' => 'fab fa-facebook-f',
                    ],
                    [
                        'key' => 'url',
                        'value' => 'https://www.facebook.com/',
                    ],
                ],
                [
                    [
                        'key' => 'name',
                        'value' => 'Instagram',
                    ],
                    [
                        'key' => 'social-icon',
                        'value' => 'fab fa-instagram',
                    ],
                    [
                        'key' => 'url',
                        'value' => 'https://www.instagram.com/',
                    ],
                ],
                [
                    [
                        'key' => 'name',
                        'value' => 'Twitter',
                    ],
                    [
                        'key' => 'social-icon',
                        'value' => 'fab fa-twitter',
                    ],
                    [
                        'key' => 'url',
                        'value' => 'https://www.twitter.com/',
                    ],
                ],
                [
                    [
                        'key' => 'name',
                        'value' => 'YouTube',
                    ],
                    [
                        'key' => 'social-icon',
                        'value' => 'fab fa-youtube',
                    ],
                    [
                        'key' => 'url',
                        'value' => 'https://www.youtube.com/',
                    ],
                ],
            ],
        ]));

        Setting::save();
    }
}
