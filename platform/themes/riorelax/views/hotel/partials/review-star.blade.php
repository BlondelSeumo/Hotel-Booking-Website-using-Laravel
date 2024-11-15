<div class="d-flex items-center">
    <p class="">{{ __(':avg out of 5', ['avg' => number_format($avgStar, 1)]) }}</p>
    <div class="rating-wrap ms-1">
        <div class="rating">
            <div class="review-rate" style="width: {{ $avgStar * 20 }}%"></div>
        </div>
    </div>
</div>
