<div class="swatches-container">
    <div class="header">
        <div class="swatch-item">
            {{ trans('plugins/hotel::currency.name') }}
        </div>
        <div class="swatch-item">
            {{ trans('plugins/hotel::currency.symbol') }}
        </div>
        <div class="swatch-item swatch-decimals">
            {{ trans('plugins/hotel::currency.number_of_decimals') }}
        </div>
        <div class="swatch-item swatch-exchange-rate">
            {{ trans('plugins/hotel::currency.exchange_rate') }}
        </div>
        <div class="swatch-item swatch-is-prefix-symbol">
            {{ trans('plugins/hotel::currency.is_prefix_symbol') }}
        </div>
        <div class="swatch-is-default">
            {{ trans('plugins/hotel::currency.is_default') }}
        </div>
        <div class="remove-item">{{ trans('plugins/hotel::currency.remove') }}</div>
    </div>

    <ul class="swatches-list"></ul>

    <div class="d-flex justify-content-between w-100 align-items-center">
        <a class="js-add-new-attribute" href="javascript:void(0)">
            {{ trans('plugins/hotel::currency.new_currency') }}
        </a>
        <x-core::form.helper-text>
            {{ trans('plugins/hotel::currency.instruction') }}
        </x-core::form.helper-text>
    </div>
</div>
