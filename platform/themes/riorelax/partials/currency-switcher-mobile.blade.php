@if (is_plugin_active('hotel') && count($currencies = get_all_currencies()) > 0)
    @foreach ($currencies as $currency)
        <li>
            <a @class(['active' => $currency->id === get_application_currency_id()]) class="currency-item" href="{{ route('public.change-currency', $currency->title) }}">{{ $currency->title }}</a>
        </li>
    @endforeach
@endif
