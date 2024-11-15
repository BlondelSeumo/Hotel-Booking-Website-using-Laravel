<section class="services-area pt-90 pb-90">
    <div class="container">
        <div class="row">
            @foreach ($rooms as $room)
                <div class="col-xl-4 col-md-6">
                    {!! Theme::partial('rooms.item', compact('room', 'startDate', 'endDate', 'nights', 'adults')) !!}
                </div>
            @endforeach
        </div>
    </div>
</section>
