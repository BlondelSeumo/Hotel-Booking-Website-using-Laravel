<section class="services-area pt-90 pb-90">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-12">
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
        </div>
        <div class="row services-active">
            @foreach($rooms as $room)
                <div class="col-xl-4 col-md-6">
                    @php($margin = true)
                    {!! Theme::partial('rooms.item', compact('room', 'startDate', 'endDate', 'nights', 'adults', 'margin')) !!}
                </div>
            @endforeach
        </div>
    </div>
</section>
