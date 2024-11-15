<section class="newslater-area p-relative pt-90 pb-90" @if($backgroundColor = $shortcode->background_color) style="background-color: {{ $backgroundColor }};" @endif>
    @if($floatingImage = $shortcode->left_floating_image)
        <div class="animations-01">
            <img src="{{ RvMedia::getImageURL($floatingImage) }}" alt="{{ $shortcode->title }}">
        </div>
    @endif
    <div class="container">
        <div class="row justify-content-center align-items-center text-center">
            <div class="col-xl-9 col-lg-9">
                <div class="section-title center-align mb-40 text-center wow fadeInDown animated" data-animation="fadeInDown" data-delay=".4s">
                    @if($subtitle = $shortcode->subtitle)
                        <h5>{{ $subtitle }}</h5>
                    @endif

                    @if($title = $shortcode->title)
                        <h2>
                            {!! BaseHelper::clean($title) !!}
                        </h2>
                    @endif

                    @if($description = $shortcode->description)
                        <p>{!! BaseHelper::clean($description) !!}</p>
                    @endif
                </div>
                <form name="ajax-form" id="contact-form4" dir="ltr" action="{{ route('public.newsletter.subscribe') }}" method="POST" class="newslater newsletter-form">
                    @csrf
                    <div class="form-group">
                        <input class="form-control" id="email" name="email" type="email" placeholder="{{ __('Your Email Address') }}" required>
                        <button type="submit" class="btn btn-custom" id="send2">{{ __('Subscribe Now') }}</button>
                    </div>
                    {!! apply_filters('form_extra_fields_render', null, \Botble\Newsletter\Forms\Fronts\NewsletterForm::class) !!}
                </form>
            </div>
        </div>
    </div>
</section>
