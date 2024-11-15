<section class="pt-100 pb-90 p-relative">
    @if ($bgImage = $shortcode->background_image)
        <div class="animations-01">
            <img src="{{ RvMedia::getImageUrl($bgImage) }}" alt="{{ __('Background image') }}">
        </div>
    @endif
        <div class="container">
            <div class="row align-items-center">
                @foreach($services as $service)
                    <div class="col-lg-4 col-md-6">
                        <div class="services-08-item mb-30">
                            @if ($image = $service->image)
                                <div class="services-icon2">
                                    <img src="{{ RvMedia::getImageUrl($image) }}" alt="{{ $service->name }}">
                                </div>
                                <div class="services-08-thumb">
                                    <img src="{{ RvMedia::getImageUrl($image) }}" alt="{{ $service->name }}">
                                </div>
                            @endif
                            <div class="services-08-content">
                                <h3><a href="{{ $service->url }}">{{ $service->name }}</a></h3>
                                <p>{!! BaseHelper::clean(Str::limit($service->description, 120)) !!}</p>
                                <a href="{{ $service->url }}">{{ __('Read More') }}<i class="fal fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
</section>
