<section class="feature-area2 p-relative fix" style="background: #f7f5f1;">
    @if($floatingImage = $shortcode->right_floating_image)
        <div class="animations-02">
            <img src="{{ RvMedia::getImageURL($floatingImage) }}" alt="{{ $shortcode->title }}" />
        </div>
    @endif
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-6 col-md-12 col-sm-12 pr-30">
                @if($leftImage = $shortcode->left_image)
                    <div class="feature-img">
                        <img src="{{ RvMedia::getImageURL($leftImage) }}" alt="{{ $shortcode->title }}" class="img" />
                    </div>
                @endif
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="feature-content s-about-content">
                    @if($shortcode->title || $shortcode->subtitle)
                        <div class="feature-title pb-20">
                            @if($subtitle = $shortcode->subtitle)
                                <h5>{{ $subtitle }}</h5>
                            @endif

                            @if($title = $shortcode->title)
                                <h2>
                                    {!! BaseHelper::clean($title) !!}
                                </h2>
                            @endif
                        </div>
                    @endif

                    @if($description = $shortcode->description)
                        <p>{!! BaseHelper::clean($description) !!}</p>
                    @endif

                    @if($shortcode->button_label && $shortcode->button_url)
                        <div class="slider-btn mt-15">
                            <a href="{{ $shortcode->button_url }}" class="btn ss-btn smoth-scroll">{{ $shortcode->button_label }}</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
