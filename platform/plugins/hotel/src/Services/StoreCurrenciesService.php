<?php

namespace Botble\Hotel\Services;

use Botble\Hotel\Models\Currency;

class StoreCurrenciesService
{
    public function execute(array $currencies, array $deletedCurrencies): void
    {
        if ($deletedCurrencies) {
            Currency::query()->whereIn('id', $deletedCurrencies)->delete();
        }

        foreach ($currencies as $item) {
            if (! $item['title'] || ! $item['symbol']) {
                continue;
            }

            $item['title'] = mb_substr(strtoupper($item['title']), 0, 3);
            $item['symbol'] = mb_substr($item['symbol'], 0, 10);
            $item['decimals'] = $item['decimals'] < 10 ? $item['decimals'] : 2;

            if (count($currencies) == 1) {
                $item['is_default'] = 1;
            }

            $currency = Currency::query()->find($item['id']);

            if (! $currency) {
                Currency::query()->create($item);
            } else {
                $currency->update($item);
            }
        }
    }
}
