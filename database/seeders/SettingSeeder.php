<?php

namespace Database\Seeders;

use Botble\Base\Supports\BaseSeeder;
use Botble\Blog\Models\Category;
use Botble\Blog\Models\Post;
use Botble\Setting\Facades\Setting;
use Botble\Slug\Facades\SlugHelper;
use Botble\Slug\Models\Slug;

class SettingSeeder extends BaseSeeder
{
    public function run(): void
    {
        $settings = [
            'admin_logo' => 'general/logo.png',
            'admin_favicon' => 'general/favicon.png',
            SlugHelper::getPermalinkSettingKey(Post::class) => 'news',
            SlugHelper::getPermalinkSettingKey(Category::class) => 'news',

            'payment_cod_status' => 1,
            'payment_cod_description' => 'Please pay money directly to the postman, if you choose cash on delivery method (COD).',
            'payment_bank_transfer_status' => 1,
            'payment_bank_transfer_description' => 'Please send money to our bank account: ACB - 69270 213 19.',
            'payment_stripe_payment_type' => 'stripe_checkout',
            'language_switcher_display' => 'dropdown',
            'hotel_company_logo_for_invoicing' => 'general/logo-dark.png',
            'hotel_company_address_for_invoicing' => '123, My Street, Kingston, New York',
            'hotel_company_email_for_invoicing' => 'contact@archielite.com',
            'hotel_company_phone_for_invoicing' => '123456789',
            'hotel_enable_review_room' => true,
            'hotel_reviews_per_page' => 10,
        ];

        Setting::delete(array_keys($settings));

        Setting::set($settings)->save();

        Slug::query()->where('reference_type', Post::class)->update(['prefix' => 'news']);
        Slug::query()->where('reference_type', Category::class)->update(['prefix' => 'news']);
    }
}
