<section class="hotel-service-area pt-40 pb-40 p-relative">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <div class="section-title center-align mb-50 text-center">
                    @if ($subtitle = $shortcode->subtitle)
                        <h5>{!! BaseHelper::clean($subtitle) !!}</h5>
                    @endif

                    @if ($title = $shortcode->title)
                        <h2>{!! BaseHelper::clean($title) !!}</h2>
                    @endif

                    @if ($description = $shortcode->description)
                        <p>{!! BaseHelper::clean($description) !!}</p>
                    @endif
                </div>
            </div>

            @foreach($services as $service)
                <div class="col-lg-4 col-md-6 services">
                    <div class="services-08-item service-item mb-30">
                        @if ($image = $service->image)
                            @php
                                $imageHtml = RvMedia::image($image, $service->name, 'thumb');
                            @endphp
                            <div class="services-icon2">
                                {{ $imageHtml }}
                            </div>
                            <div class="services-08-thumb">
                                {{ $imageHtml }}
                            </div>
                        @endif

                        <div class="services-08-content">
                            <h3><a href="{{ $service->url }}"> {{ $service->name }} </a></h3>

                            <div class="mb-3 h6 service-price">
                                {{ format_price($service->price) . '/' . $service->price_type->label() }}
                            </div>

                            @if ($description = $service->description)
                                <p title="{{ $description }}">{!! BaseHelper::clean(Str::limit($description, 80)) !!}</p>
                            @endif

                            <a href="{{ $service->url }}">{{ __('Read More') }} <i class="fal fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
