<section id="blog" class="blog-area p-relative fix pt-90 pb-90">
    @if ($bgImage = $shortcode->bg_image)
        <div class="animations-02">
            <img src="{{ RvMedia::getImageUrl($bgImage) }}" alt="{{ __('Background image') }}">
        </div>
    @endif

    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <div class="section-title center-align mb-50 text-center wow fadeInDown animated" data-animation="fadeInDown" data-delay=".4s">
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
        </div>
        @if ($posts->isNotEmpty())
            <div class="row">
                @foreach($posts as $post)
                    <div class="col-lg-4 col-md-6">
                        {!! Theme::partial('blog.post.item', compact('post')) !!}
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
