<div class="service-detail-contact wow fadeup-animation" data-wow-delay="1.1s">
    @if ($title = $config['title'])
        <h3 class="h3-title">{!! BaseHelper::clean($title) !!}</h3>
    @endif

    @if ($phone = $config['phone'])
        <a href="tel:{{ $phone }}" title="{{ __('Call now') }}">{{ $phone }}</a>
    @endif
</div>
