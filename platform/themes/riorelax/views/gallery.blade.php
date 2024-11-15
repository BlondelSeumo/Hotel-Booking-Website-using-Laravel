@php
    Theme::set('pageTitle',  $gallery->name);
@endphp

@if (function_exists('get_galleries'))
    <div class="container mt-50 mb-50">
        <h6 class="custom-gallery-description text-center">{!! BaseHelper::clean($gallery->description) !!}</h6>
        <div class="row mt-50">
            <article class="post post--single">
                <div class="post__content">
                    <div class="row" id="list-photo">
                        @foreach (gallery_meta_data($gallery) as $image)
                            @if ($image)
                                <div class="col-12 col-md-4 mt-20" data-src="{{ RvMedia::getImageUrl(Arr::get($image, 'img'), 'galleries') }}" data-sub-html="{{ BaseHelper::clean(Arr::get($image, 'description')) }}">
                                    <div class="photo-item">
                                        <div class="thumb">
                                            <a href="{{ BaseHelper::clean(Arr::get($image, 'description')) }}">
                                                <img src="{{ RvMedia::getImageUrl(Arr::get($image, 'img'), 'galleries') }}" alt="{{ BaseHelper::clean(Arr::get($image, 'description')) }}">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </article>
        </div>
    </div>
@endif
