@php($bgColor = $shortcode->background_color ?: '#f7f5f1')

<section id="service-details2" class="pt-90 pb-90 p-relative" style="background-color: {{ $bgColor }};">
    @if ($bgImage = $shortcode->background_image)
        <div class="animations-01">
            <img src="{{ RvMedia::getImageUrl($bgImage) }}" alt="{{ __('Background image') }}">
        </div>
    @endif
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
            @foreach($amenities as $amenity)
                <div class="col-lg-4 col-md-6">
                    <div class="services-08-item mb-30">
                        @if ($image = $amenity->getMetaData('icon_image', true))
                            <div class="services-icon2">
                                <img src="{{ RvMedia::getImageUrl($image) }}" alt="{{ $amenity->name }}">
                            </div>
                            <div class="services-08-thumb">
                                <img src="{{ RvMedia::getImageUrl($image) }}" alt="{{ $amenity->name }}">
                            </div>
                        @endif

                        <div class="services-08-content">
                            <h3>{{ $amenity->name }}</h3>

                            @if ($description = $amenity->getMetaData('description', true))
                                <p title="{{ $description }}">{!! BaseHelper::clean(Str::limit($description, 80)) !!}</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
