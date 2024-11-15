@extends(HotelHelper::viewPath('customers.master'))

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1 class="text-center mb-20">{{ SeoHelper::getTitle() }}</h1>
        </div>

        <div class="panel-body">
            <div class="section-content">
                <div class="table-responsive mb-20">
                    <table class="table table-striped custom-review-table">
                        <thead class="text-center">
                            <tr>
                                <th style="width: 15%">{{ __('Room') }}</th>
                                <th style="width: 15%">{{ __('Image') }}</th>
                                <th>{{ __('Content') }}</th>
                            </tr>
                        </thead>

                        <tbody class="text-center">
                        @if (count($reviews) > 0)
                            @foreach ($reviews as $review)
                                @php($room = $review->room)
                                <tr class="align-middle">
                                        <td>
                                            <a class="review-information-link" href="{{ $room->url }}" target="_blank">
                                                {{ $room->name }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ $room->url }}" target="_blank">
                                                <img src="{{ RvMedia::getImageUrl($room->image, 'thumb', false, RvMedia::getDefaultImage()) }}" alt="{{ $review->room->name }}" width="120">
                                            </a>
                                        </td>
                                    <td>{{ $review->content }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center">{{ __('No reviews!') }}</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>

                {!! $reviews->links(HotelHelper::viewPath('partials.pagination')) !!}
            </div>
        </div>
    </div>
@stop
