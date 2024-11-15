<?php

namespace Botble\Hotel\Forms\Settings;

use Botble\Hotel\Http\Requests\Settings\ReviewSettingRequest;
use Botble\Setting\Forms\SettingForm;

class ReviewSettingForm extends SettingForm
{
    public function setup(): void
    {
        parent::setup();

        $this
            ->setSectionTitle(trans('plugins/hotel::settings.review.title'))
            ->setSectionDescription(trans('plugins/hotel::settings.review.description'))
            ->setValidatorClass(ReviewSettingRequest::class)
            ->add('hotel_enable_review_room', 'onOffCheckbox', [
                'label' => trans('plugins/hotel::settings.review.enable_review_room'),
                'value' => setting('hotel_enable_review_room', true),
            ])
            ->add('hotel_reviews_per_page', 'number', [
                'label' => trans('plugins/hotel::settings.review.reviews_per_page'),
                'value' => setting('hotel_reviews_per_page', 10),
            ]);
    }
}
