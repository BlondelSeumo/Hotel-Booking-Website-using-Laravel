<section class="services-area pt-20 pb-40">
    <h3 class="mb-20">{{ __(':count rooms available', ['count' => $rooms->total()]) }}</h3>

    @if ($rooms->isNotEmpty())
        <div class="row">
            @foreach ($rooms as $room)
                <div class="col-md-6">
                    {!! Theme::partial('rooms.item', compact('room', 'startDate', 'endDate', 'nights', 'adults')) !!}
                </div>
            @endforeach
        </div>
        @if ($rooms instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator)
            <div class="text-center mt-30">
                {!! $rooms->withQueryString()->links(Theme::getThemeNamespace('partials.pagination')) !!}
            </div>
        @endif
    @endif
</section>

