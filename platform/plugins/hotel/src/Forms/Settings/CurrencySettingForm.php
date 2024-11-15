<?php

namespace Botble\Hotel\Forms\Settings;

use Botble\Base\Facades\Assets;
use Botble\Hotel\Http\Requests\Settings\CurrencySettingRequest;
use Botble\Hotel\Models\Currency;
use Botble\Setting\Forms\SettingForm;

class CurrencySettingForm extends SettingForm
{
    public function setup(): void
    {
        parent::setup();

        Assets::addScripts(['jquery-ui'])
            ->addScriptsDirectly('vendor/core/plugins/hotel/js/currencies.js')
            ->addStylesDirectly('vendor/core/plugins/hotel/css/currencies.css');

        $currencies = Currency::query()
            ->orderBy('order')
            ->get()
            ->all();

        $this
            ->setSectionTitle(trans('plugins/hotel::settings.currency.title'))
            ->setSectionDescription(trans('plugins/hotel::settings.currency.description'))
            ->setFormOptions([
                'class' => 'main-setting-form',
            ])
            ->contentOnly()
            ->setValidatorClass(CurrencySettingRequest::class)
            ->add('hotel_enable_auto_detect_visitor_currency', 'onOffCheckbox', [
                'label' => trans('plugins/hotel::currency.enable_auto_detect_visitor_currency') ,
                'value' => setting('hotel_enable_auto_detect_visitor_currency', false),
                'help_block' => [
                    'text' => trans('plugins/hotel::currency.auto_detect_visitor_currency_description'),
                ],
            ])
            ->add('hotel_add_space_between_price_and_currency', 'onOffCheckbox', [
                'label' => trans('plugins/hotel::currency.add_space_between_price_and_currency'),
                'value' => setting('hotel_add_space_between_price_and_currency', false),
            ])
            ->add('hotel_thousands_separator', 'customSelect', [
                'label' => trans('plugins/hotel::currency.thousands_separator'),
                'selected' => setting('hotel_thousands_separator', ','),
                'choices' => [
                    ',' => trans('plugins/hotel::currency.separator_comma'),
                    '.' => trans('plugins/hotel::currency.separator_period'),
                    'space' => trans('plugins/hotel::currency.separator_space'),
                ],
            ])
            ->add('data_currencies', 'html', [
                'html' => view('plugins/hotel::settings.partials.currencies.data-currency-fields', compact('currencies')),
            ])
            ->add('currency_table', 'html', [
                'html' => view('plugins/hotel::settings.partials.currencies.currency-table'),
            ]);
    }
}
