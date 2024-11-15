<?php

namespace Botble\Hotel\Http\Controllers\Settings;

use Botble\Hotel\Forms\Settings\ReviewSettingForm;
use Botble\Hotel\Http\Requests\Settings\ReviewSettingRequest;
use Botble\Setting\Http\Controllers\SettingController;

class ReviewSettingController extends SettingController
{
    public function edit()
    {
        $this->pageTitle(trans('plugins/hotel::settings.review.title'));

        return ReviewSettingForm::create()->renderForm();
    }

    public function update(ReviewSettingRequest $request)
    {
        return $this->performUpdate($request->validated());
    }
}
