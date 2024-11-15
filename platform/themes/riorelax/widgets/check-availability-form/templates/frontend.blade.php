<div class="sidebar-widget categories check-availability-custom">
    <div class="widget-content">
        @if ($title = $config['title'])
            <h2 class="widget-title"> {!! BaseHelper::clean($title) !!}  </h2>
        @endif
        <div class="booking">
            <div class="contact-bg">
                {!! Theme::partial('hotel.forms.form', ['style' => 1, 'availableForBooking' => false]) !!}
            </div>
        </div>
    </div>
</div>
