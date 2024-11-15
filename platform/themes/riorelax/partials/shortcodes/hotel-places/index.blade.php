<section class="hotel-place-area p-relative fix pt-40 pb-40">
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
        <div class="row">
            @foreach($places as $place)
                <div class="col-lg-3 col-md-4">
                    <div class="bsingle__post mb-50">
                        <div class="bsingle__post-thumb blog-active hover-zoomin wow fadeInUp animated">
                            @if($image = $place->image)
                                <div class="slide-post">
                                    <a title="{{ $place->name }}" class="blog-item-custom-truncate" href="{{ $place->url }}">
                                        {{ RvMedia::image($image, $place->name, 'medium') }}
                                    </a>
                                </div>
                            @endif

                        </div>
                        <div class="bsingle__content">
                            <div class="date-home">
                                {{ $place->created_at->translatedFormat('dS F Y') }}
                            </div>
                            <h2><a title="{{ $place->name }}" class="blog-item-custom-truncate" href="{{ $place->url }}">{{ $place->name }}</a></h2>

                            @if ($distance = $place->distance)
                                <p class="blog-item-custom-truncate mb-0">
                                    <x-core::icon name="ti ti-map-pin"/>
                                    {!! BaseHelper::clean($distance) !!}
                                </p>
                            @endif
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    </div>
</section>
