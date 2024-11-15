<div class="bsingle__post mb-50">
    <div class="bsingle__post-thumb blog-active hover-zoomin wow fadeInUp animated">
        @if($image = $post->image)
            <div class="slide-post">
                <a title="{{ $post->name }}" class="blog-item-custom-truncate" href="{{ $post->url }}">
                    <img src="{{ RvMedia::getImageUrl($image, 'medium') }}" alt="{{ $post->name }}">
                </a>
            </div>
        @endif

    </div>
    <div class="bsingle__content">
        <div class="date-home">
            {{ $post->created_at->translatedFormat('dS F Y') }}
        </div>
        <h2><a title="{{ $post->name }}" class="blog-item-custom-truncate" href="{{ $post->url }}">{{ $post->name }}</a></h2>

        @if ($description = $post->description)
            <p class="blog-item-custom-truncate" title="{{ $description }}">{!! BaseHelper::clean($description) !!}</p>
        @endif
        <div class="blog__btn">
            <a href="{{ $post->url }}">{{ __('Read More') }}</a>
        </div>
    </div>
</div>
