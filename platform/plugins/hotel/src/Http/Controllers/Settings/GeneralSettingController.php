<?php

namespace Botble\Hotel\Http\Controllers\Settings;

use Botble\Hotel\Forms\Settings\GeneralSettingForm;
use Botble\Hotel\Http\Requests\Settings\GeneralSettingRequest;
use Botble\Setting\Http\Controllers\SettingController;

class GeneralSettingController extends SettingController
{
    public function edit()
    {
        $this->pageTitle(trans('plugins/hotel::settings.general.title'));

        return GeneralSettingForm::create()->renderForm();
    }

    public function update(GeneralSettingRequest $request)
    {
        return $this->performUpdate($request->validated());
    }
}
