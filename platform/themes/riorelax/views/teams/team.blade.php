@php(Theme::set('pageTitle', __('Team Details')))

<section class="team-area-content" >
    <div class="container">
        <div class="lower-content">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-sm-12">
                    @if ($image = $team->photo)
                        <div class="team-img-box">
                            <img src="{{ RvMedia::getImageUrl($image) }}" alt="{{ $team->name }}">
                        </div>
                    @endif

                    <div class="per-info">
                        <h4>{{ $team->name }}</h4>
                        <ul>
                            @if ($email = $team->email)
                                <li>
                                    <div class="icon">
                                        <i class="fal fa-envelope"></i> <strong>{{ __('Email') }}</strong>
                                    </div>
                                    <a href="mailto:{{ $email }}" class="text">{{ $email }}</a>
                                </li>
                            @endif

                            @if ($phone = $team->phone)
                                <li>
                                    <div class="icon">
                                        <i class="fal fa-phone"></i> <strong>{{ __('Phone') }}</strong>
                                    </div>
                                    <a href="tel:{{ $phone }}" class="text">{{ $phone }}</a>
                                </li>
                            @endif

                            @if ($address = $team->address)
                                <li>
                                    <div class="icon"><i class="fal fa-map-marker-alt"></i>
                                        <strong>{{ __('Address') }}</strong>
                                    </div>
                                    <a class="text" title="{{ $address }}">{!! BaseHelper::clean(Str::limit($address, 20)) !!}</a>
                                </li>
                            @endif

                            @if ($website = $team->website)
                                <li>
                                    <div class="icon"><i class="fal fa-globe"></i><strong>{{ __('Website') }}</strong></div>
                                    <a href="{{ $website }}" target="_blank" class="text">{{ $website }}</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>

                <div class="text-column col-lg-8 col-md-12 col-sm-12">
                    <div class="s-about-content pl-30 wow fadeInRight" data-animation="fadeInRight" data-delay=".2s">
                        {!! BaseHelper::clean($team->content) !!}
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
