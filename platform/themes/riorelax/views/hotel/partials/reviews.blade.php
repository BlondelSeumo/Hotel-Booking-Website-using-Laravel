@php
    Theme::asset()->usePath()->add('jquery-bar-rating-css', 'plugins/jquery-bar-rating/css-stars.css');
    Theme::asset()->container('footer')->usePath()->add('jquery-bar-rating-js', 'plugins/jquery-bar-rating/jquery.barrating.min.js');
    Theme::asset()->container('footer')->usePath()->add('review-js', 'js/review.js');
@endphp

@if(HotelHelper::isReviewEnabled())
    @php
        $canReview = false;
        if ($isLoggedIn = auth('customer')->check()) {
            $hasBooked = auth('customer')->user()->hasBooked($model);
            $hasReviewed = auth('customer')->user()->hasReviewed($model);
            $canReview = $hasBooked && ! $hasReviewed;
        }
    @endphp
    <div class="room-block-content shadow-block mt-50">
        <div>
            <div>
                <h3 class="text-xl">{{ __('Write a review') }}</h3>
                <form action="{{ route('customer.ajax.review.store', $model->slug) }}" method="post" class="space-y-3 review-form">
                    @csrf
                    <input type="hidden" name="room_id" value="{{ $model->id }}">
                    <div class="text-start mb-20">
                        <select name="star" id="select-star">
                            @foreach(range(1, 5) as $i)
                                <option value="{{ $i }}" @selected(old('score', 5) === $i)>{{ $i }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <textarea name="content" id="content" class="form-input custom-review-input mb-20" placeholder="{{ __('Enter your message') }}" @disabled(! $canReview)>{{ old('content') }}</textarea>
                    </div>

                    @if (! $isLoggedIn)
                        <p class="text-danger">{{ __('Please log in to write review!') }}</p>
                    @else
                        @if (! $hasBooked)
                            <p class="text-danger">{{ __('You need book this room to write a review!') }}</p>
                        @elseif ($hasReviewed)
                            <p class="text-danger">{{ __('You have written a review for this room!') }}</p>
                        @endif
                    @endif

                    <button type="submit" @class(['custom-submit-review-btn mb-20']) @disabled(! $canReview)>
                        {{ __('Submit review') }}
                    </button>
                </form>
            </div>
            <div class="pt-8 mt-8 border-top">
                @if($model->reviews_count)
                    <div class="d-flex justify-content-between mt-10 mb-20 reviews-block">
                        <h4 class="">
                            <span class="reviews-count">{{ __(':count Review(s)', ['count' => $model->approved_review_count]) }}</span>
                        </h4>
                        <div class="loading-spinner d-none"></div>

                        @include(Theme::getThemeNamespace('views.hotel.partials.review-star'), ['avgStar' => $model->reviews_avg_star, 'count' => $model->reviews_count])
                    </div>
                @endif
                <div @class(['reviews-list mb-20', 'mt-10' => $model->approved_review_count]) data-url="{{ route('customer.ajax.review.index', $model->slug) }}?"></div>
            </div>
        </div>
    </div>
@endif
