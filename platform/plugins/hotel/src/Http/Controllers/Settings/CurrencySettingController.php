<?php

namespace Botble\Hotel\Http\Controllers\Settings;

use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Hotel\Forms\Settings\CurrencySettingForm;
use Botble\Hotel\Http\Requests\Settings\CurrencySettingRequest;
use Botble\Hotel\Services\StoreCurrenciesService;
use Botble\Setting\Http\Controllers\SettingController;

class CurrencySettingController extends SettingController
{
    public function edit()
    {
        $this->pageTitle(trans('plugins/hotel::currency.currencies'));

        $form = CurrencySettingForm::create();

        return view('plugins/hotel::settings.currency', compact('form'));
    }

    public function update(CurrencySettingRequest $request, BaseHttpResponse $response, StoreCurrenciesService $service)
    {
        $this->saveSettings($request->except([
            'currencies',
            'currencies_data',
            'deleted_currencies',
        ]));

        $currencies = json_decode($request->validated('currencies'), true) ?: [];

        if (! $currencies) {
            return $response
                ->setNextUrl(route('hotel.settings.currencies'))
                ->setError()
                ->setMessage(trans('plugins/hotel::currency.require_at_least_one_currency'));
        }

        $deletedCurrencies = json_decode($request->input('deleted_currencies', []), true) ?: [];

        $service->execute($currencies, $deletedCurrencies);

        return $response->withUpdatedSuccessMessage();
    }
}
