<section class="testimonial-area pt-90 pb-90 p-relative fix"
         @if($bgImage = $shortcode->background_image) style="background-image: url('{{ RvMedia::getImageUrl($bgImage) }}'); background-size: cover;" @endif
>
    <div class="container">
        <div class="row">
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

            @if($testimonials->isNotEmpty())
                <div class="col-lg-12">
                    <div class="testimonial-active">
                        @foreach($testimonials as $testimonial)
                            <div class="single-testimonial">
                                <div class="testi-author">
                                    <img src="{{ RvMedia::getImageUrl($testimonial->image) }}" alt="{{ $testimonial->name }}">
                                    <div class="ta-info w-100">
                                        <h6>{{ $testimonial->name }}</h6>
                                    </div>
                                </div>
                                <div class="review-icon">
                                    <img src="{{ Theme::asset()->url('/images/testimonials/review-icon.png') }}" alt="{{ __('Icon reviews') }}">
                                </div>

                                <p>{!! BaseHelper::clean($testimonial->content) !!}</p>

                                <div class="qt-img">
                                    <img src="{{ Theme::asset()->url('/images/testimonials/qt-icon.png') }}" alt="{{ __('Icon') }}">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
