<section id="pricing" class="pricing-area pt-90 pb-60 fix p-relative">
    @if($bgImage1 = $shortcode->background_image_1)
        <div class="animations-01">
            <img src="{{ RvMedia::getImageUrl($bgImage1) }}" alt="{{ __('Background image 1') }}">
        </div>
    @endif

    @if ($bgImage2 = $shortcode->background_image_2)
        <div class="animations-02">
            <img src="{{ RvMedia::getImageUrl($bgImage2) }}" alt="{{ __('Background image 2') }}">
        </div>
    @endif

    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-4 col-md-12">
                <div class="section-title mb-20">
                    @if ($subtitle = $shortcode->subtitle)
                        <h5>{!! BaseHelper::clean($subtitle) !!}</h5>
                    @endif

                    @if ($title = $shortcode->title)
                        <h2>{!! BaseHelper::clean($title) !!}</h2>
                    @endif
                </div>

                @if ($description = $shortcode->description)
                    <p>{!! BaseHelper::clean($description) !!}</p>
                @endif
            </div>

            @foreach($tabs as $tab)
                <div class="col-lg-4 col-md-6">
                    <div class="pricing-box pricing-box2 mb-60">
                        <div class="pricing-head">
                            @if ($tab['title'])
                                <h3>{!! BaseHelper::clean($tab['title']) !!}</h3>
                            @endif

                            @if ($tab['description'])
                                <p>{!! BaseHelper::clean($tab['description']) !!}</p>
                            @endif

                            @if ($tab['duration'])
                                <div class="month">{!! BaseHelper::clean($tab['duration']) !!}</div>
                            @endif

                            @if ($tab['price'])
                                <div class="price-count">
                                    <h2>{!! BaseHelper::clean($tab['price']) !!}</h2>
                                </div>
                            @endif
                            <hr>
                        </div>

                        @if ($tab['feature_list'])
                            @php
                                $featureList = explode(',', $tab['feature_list'])
                            @endphp

                            @if(count($featureList) > 0)
                                <div class="pricing-body mt-20 mb-30 text-start">
                                    <ul>
                                        @foreach($featureList as $feature)
                                            <li>{!! BaseHelper::clean($feature) !!}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        @endif

                        @if ($tab['button_label'] && $tab['button_url'])
                            <div class="pricing-btn">
                                <a href="{{ $tab['button_url'] }}" class="btn ss-btn">{!! BaseHelper::clean($tab['button_label']) !!}<i class="fal fa-angle-right"></i></a>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
