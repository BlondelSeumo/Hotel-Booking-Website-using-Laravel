@php($bgColor = $shortcode->background_color ?: '#101010')

<section class="slider-area fix p-relative">
    <div class="slider-active" style="background: {{ $bgColor }};">
        <div class="single-slider slider-bg d-flex align-items-center"
             @if ($bgImage = $shortcode->background_image)
                 style="background-image: url('{{ RvMedia::getImageUrl($bgImage) }}'); background-size: cover;"
             @endif
        >
            <div class="container">
                <div class="row justify-content-center align-items-center">

                    <div class="col-lg-7 col-md-7">
                        <div class="slider-content s-slider-content mt-100">
                            @if ($title = $shortcode->title)
                                <h2 data-animation="fadeInUp" data-delay=".4s">{!! BaseHelper::clean($title) !!}</h2>
                            @endif

                            @if ($description = $shortcode->description)
                                <p data-animation="fadeInUp" data-delay=".6s">{!! BaseHelper::clean($description) !!}</p>
                            @endif

                            @if (($buttonLabel = $shortcode->button_label) && ($buttonUrl = $shortcode->button_url))
                                <div class="slider-btn mt-30 mb-105">
                                    <a href="{{ $buttonUrl }}" class="btn ss-btn active" data-animation="fadeInLeft" data-delay=".4s">
                                        {!! BaseHelper::clean($buttonLabel) !!}
                                    </a>
                                </div>
                            @endif

                        </div>
                    </div>
                    <div class="col-lg-5 col-md-5 p-relative">
                        <div class="booking-area booking-area2 p-relative">
                            <div class="container">
                                {!! Theme::partial('hotel.forms.form', ['style' => 1, 'availableForBooking' => false, 'title' => $shortcode->form_title]) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
