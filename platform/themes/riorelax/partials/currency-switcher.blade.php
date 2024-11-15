@if (is_plugin_active('hotel') && count($currencies = get_all_currencies()) > 0)
    <div class="dropdown currencies-switcher d-inline-flex align-items-center">
        <a class="dropdown-toggle" type="button" id="currency-switcher-dropdown" data-bs-toggle="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ get_application_currency()->title }}
        </a>
        <div class="dropdown-menu currency-switcher-list" aria-labelledby="currency-switcher-dropdown">
            @foreach ($currencies as $currency)
                @continue($currency->id === get_application_currency_id())
                <li>
                    <a class="currency-item" href="{{ route('public.change-currency', $currency->title) }}">{{ $currency->title }}</a>
                </li>
            @endforeach
        </div>
    </div>
@endif

