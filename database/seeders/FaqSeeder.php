<?php

namespace Database\Seeders;

use Botble\Base\Supports\BaseSeeder;
use Botble\Faq\Models\Faq;
use Botble\Faq\Models\FaqCategory;

class FaqSeeder extends BaseSeeder
{
    public function run(): void
    {
        Faq::query()->truncate();
        FaqCategory::query()->truncate();

        $categories = [
            'GENERAL INFORMATION',
            'ACCOMMODATIONS AND AMENITIES',
            'SPECIAL EVENTS',
            'SAFETY AND HEALTH',
            'EXPLORING',
        ];

        foreach ($categories as $index => $category) {
            FaqCategory::query()->create([
                'name' => $category,
                'order' => $index,
            ]);
        }

        $faqs = [
            [
                'question' => 'What sets Luxury Hotel apart from others area?',
                'answer' => 'Our hotel stands out with its prime coastal location, captivating design that harmonizes with nature, impeccable service dedicated to fulfilling every guest’s desire, and an array of world-class amenities that redefine opulence and sophistication.',
                'category_id' => 1,
            ],
            [
                'question' => 'Are pets allowed at your hotel?',
                'answer' => 'Unfortunately, as we strive to maintain an environment of tranquility and luxury for all our guests, we regret to inform you that we do not permit pets in our elegantly appointed rooms and meticulously designed public spaces.',
                'category_id' => 2,
            ],
            [
                'question' => 'Is there a service from airport to hotel?',
                'answer' => 'Absolutely! For your convenience, we offer an exclusive airport shuttle service that can be arranged in advance. Our dedicated concierge team will be delighted to provide you with detailed information and assist with reservations.',
                'category_id' => 1,
            ],
            [
                'question' => 'What dining options are available at hotel?',
                'answer' => 'Indulge in a culinary journey at our resort with a range of exquisite dining options. From elegantly crafted local and international cuisines to delightful specialty restaurants and inviting bars, every dining experience promises to tantalize your taste buds and elevate your stay to new heights of gastronomic pleasure.',
                'category_id' => 2,
            ],
            [
                'question' => 'Is there a spa and wellness center on-site?',
                'answer' => 'Embrace holistic well-being at our luxurious on-site spa and wellness center. Immerse yourself in a world of serenity and rejuvenation with a diverse selection of treatments, therapies, and state-of-the-art facilities that cater to your body, mind, and soul.',
                'category_id' => 2,
            ],
            [
                'question' => 'Do you have family-friendly activities?',
                'answer' => 'Families are warmly welcomed to our resort, where we have thoughtfully curated a range of family-friendly amenities and activities. From a dedicated kids’ club to a family pool and a host of engaging recreational options, we ensure a harmonious and enjoyable stay for guests of all ages.',
                'category_id' => 2,
            ],
            [
                'question' => 'How can I arrange special at resort?',
                'answer' => 'Celebrate life’s most precious moments in the epitome of luxury and elegance. Our skilled event planning team is committed to orchestrating seamless and memorable celebrations, ensuring every detail is tailored to your vision. Contact our dedicated events department to embark on a journey of crafting extraordinary moments.',
                'category_id' => 3,
            ],
            [
                'question' => 'What safety measures do you have for guests?',
                'answer' => 'Your well-being is our paramount concern. We have implemented stringent health and safety protocols to ensure a secure and comfortable environment for all our guests. These measures encompass enhanced cleaning procedures, social distancing guidelines, and a commitment to maintaining the highest standards of hygiene throughout the resort.',
                'category_id' => 4,
            ],
            [
                'question' => 'Can I cancel or modify my reservation?',
                'answer' => 'Our reservation policies vary based on the rate type and specific booking conditions. We kindly advise reviewing the terms and details of your reservation or reaching out to our dedicated reservations team for personalized assistance regarding cancellations or modifications. Your comfort and satisfaction remain our utmost priority.',
                'category_id' => 1,
            ],
            [
                'question' => 'What activities are near your hotel?',
                'answer' => 'Our hotel’s prime location offers easy access to a plethora of attractions. Explore the captivating Adriatic coastline, immerse yourself in historical landmarks, indulge in vibrant local culture, and embark on memorable excursions that our concierge team can readily assist in arranging.',
                'category_id' => 5,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::query()->create($faq);
        }
    }
}
