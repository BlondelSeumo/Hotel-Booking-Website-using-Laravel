<div class="col-xl-4 col-lg-4 col-sm-6">
    <div class="footer-widget mb-30">
        @if ($logo = theme_option('logo'))
            <div class="f-widget-title mb-30">
                <img src="{{ Rvmedia::getImageUrl($logo) }}" alt="{{ theme_option('site_name') }}">
            </div>
        @endif
        <div class="f-contact">
            <ul>
                @if($phoneNumber)
                    <li>
                        <i class="icon fal fa-phone"></i>
                        <span>{!! BaseHelper::clean($phoneNumber) !!}</span>
                    </li>
                @endif

                @if ($email)
                    <li>
                        <i class="icon fal fa-envelope"></i>
                        <span>{!! BaseHelper::clean($email) !!}</span>
                    </li>
                @endif

                @if($address)
                    <li>
                        <i class="icon fal fa-map-marker-check"></i>
                        <span>{!! BaseHelper::clean($address) !!}</span>
                    </li>
                @endif
            </ul>

        </div>
    </div>
</div>
