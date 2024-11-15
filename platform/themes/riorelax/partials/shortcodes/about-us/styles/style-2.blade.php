<section class="about-area about-p pt-90 pb-90 p-relative fix">
    @if($floatingRightImage = $shortcode->floating_right_image)
        <div class="animations-02">
            <img src="{{ RvMedia::getImageUrl($floatingRightImage) }}" alt="{{ $shortcode->title }}" />
        </div>
    @endif
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="s-about-img p-relative wow fadeInLeft animated" data-animation="fadeInLeft" data-delay=".4s">
                    @if($topLeftImage = $shortcode->top_left_image)
                        <img src="{{ RvMedia::getImageUrl($topLeftImage) }}" alt="{{ $shortcode->title }}" />
                    @endif

                    @if($bottomRightImage = $shortcode->bottom_right_image)
                        <div class="about-icon">
                            <img src="{{ RvMedia::getImageUrl($bottomRightImage) }}" alt="{{ $shortcode->title }}" />
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="about-content s-about-content wow fadeInRight animated pl-30" data-animation="fadeInRight" data-delay=".4s">
                    <div class="about-title second-title pb-25">
                        @if($subtitle = $shortcode->subtitle)
                            <h5>{{ $subtitle }}</h5>
                        @endif

                        @if($title = $shortcode->title)
                            <h2>{!! BaseHelper::clean($title) !!}</h2>
                        @endif
                    </div>
                    @if($description = $shortcode->description)
                        <p>
                            {!! BaseHelper::clean($description) !!}
                        </p>
                    @endif
                    <div class="about-content3 mt-30">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-md-12">
                                <ul class="green mb-30">
                                    @foreach($highlightArray as $highlight)
                                        <li>{!! BaseHelper::clean($highlight) !!}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @if($shortcode->signature_image && $shortcode->signature_author)
                                <div class="col-md-12">
                                    <div class="signature">
                                        <img src="{{ RvMedia::getImageUrl($shortcode->signature_image) }}" alt="{{ __('Signature') }}" />
                                        <h3 class="mt-10">{{ $shortcode->signature_author }}</h3>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
