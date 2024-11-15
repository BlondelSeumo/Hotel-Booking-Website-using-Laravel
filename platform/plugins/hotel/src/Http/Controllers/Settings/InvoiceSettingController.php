<?php

namespace Botble\Hotel\Http\Controllers\Settings;

use Botble\Hotel\Forms\Settings\InvoiceSettingForm;
use Botble\Hotel\Http\Requests\Settings\InvoiceSettingRequest;
use Botble\Setting\Http\Controllers\SettingController;

class InvoiceSettingController extends SettingController
{
    public function edit()
    {
        $this->pageTitle(trans('plugins/hotel::settings.invoice.title'));

        return InvoiceSettingForm::create()->renderForm();
    }

    public function update(InvoiceSettingRequest $request)
    {
        return $this->performUpdate($request->validated());
    }
}
