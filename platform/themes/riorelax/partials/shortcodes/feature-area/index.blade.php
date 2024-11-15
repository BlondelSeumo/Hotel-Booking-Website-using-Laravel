@php($bgColor = $shortcode->background_color ?: '#f7f5f1')

<section class="feature-area2 p-relative fix" style="background: {{ $bgColor }}">
    @if ($bgImage = $shortcode->background_image)
        <div class="animations-02">
            <img src="{{ RvMedia::getImageUrl($bgImage) }}" alt="{{ __('Background image') }}">
        </div>
    @endif

    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-6 col-md-12 col-sm-12 pr-30">
                @if($image = $shortcode->image)
                    <div class="feature-img">
                        <img src="{{ RvMedia::getImageUrl($image) }}" alt="{{ __('Image') }}" class="img">
                    </div>
                @endif
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="feature-content s-about-content">
                    <div class="feature-title pb-20">
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

                    @if (($buttonPrimaryLabel = ($shortcode->button_primary_label ?: $shortcode->button_label)) && ($buttonPrimaryUrl = ($shortcode->button_primary_url ?: $shortcode->button_url)))
                        <a href="{{ $buttonPrimaryUrl }}" class="btn ss-btn smoth-scroll">{!! BaseHelper::clean($buttonPrimaryLabel) !!}</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
