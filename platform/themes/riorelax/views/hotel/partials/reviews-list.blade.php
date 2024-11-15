@foreach($reviews as $review)
    <div class="d-flex border-bottom pt-10 pb-10 review-item-block">
        <div class="img-block">
            <img class="review-avatar-img" src="{{ $review->author->avatar_url }}" alt="{{ $review->author->name }}"/>
        </div>

        <div class="ms-5">
            <div class="d-flex items-center">
                <div class="rating-wrap">
                    <div class="rating">
                        <div class="review-rate" style="width: {{ $review->star * 20 }}%"></div>
                    </div>
                </div>
            </div>
            <div class="mb-2">
                <span class="reviewer-name">
                    {{ $review->author->name }}
                </span>
                <span class="review-time">{{ $review->created_at->diffForHumans() }}</span>
            </div>
            <p class="review-content">{{ $review->content }}</p>
        </div>
    </div>
@endforeach
<div class="pb-10"></div>

{{ $reviews->onEachSide(1)->links(Theme::getThemeNamespace('partials.pagination')) }}
