@extends(HotelHelper::viewPath('customers.master'))

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1 class="text-center mb-20">{{ SeoHelper::getTitle() }}</h1>
        </div>
        <div class="panel-body">
            <div class="section-content">
                <div class="table-responsive mb-20">
                    <table class="table table-striped custom-booking-table">
                        <thead class="text-center">
                            <tr>
                                <th>{{ __('Room') }}</th>
                                <th>{{ __('Image') }}</th>
                                <th>{{ __('Amount') }}</th>
                                <th>{{ __('Booking Period') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody class="text-center">
                            @if (count($bookings) > 0)
                                @foreach ($bookings as $booking)
                                    <tr class="align-middle">
                                        @if ($booking->room->room->exists && ($room = $booking->room->room))
                                            <td>
                                                <a
                                                    class="booking-information-link"
                                                    href="{{ $room->url }}"
                                                    target="_blank"
                                                >
                                                    {{ $room->name }}
                                                </a>
                                            </td>
                                            <td>
                                                <a
                                                    href="{{ $room->url }}"
                                                    target="_blank"
                                                >
                                                    <img
                                                        src="{{ RvMedia::getImageUrl($room->image, 'thumb', false, RvMedia::getDefaultImage()) }}"
                                                        alt="{{ $booking->room->name }}"
                                                        width="100"
                                                    >
                                                </a>
                                            </td>
                                        @else
                                            <td>
                                                {{ $booking->room->name }}
                                            </td>
                                            <td>
                                                <img
                                                    src="{{ RvMedia::getImageUrl($booking->room->room_image, 'thumb', false, RvMedia::getDefaultImage()) }}"
                                                    alt="{{ $booking->room->name }}"
                                                    width="100"
                                                >
                                            </td>
                                        @endif
                                        <td>{{ format_price($booking->room->price) }}</td>
                                        <td>{{ $booking->room->booking_period }}</td>
                                        <td>{{ $booking->status->label() }}</td>
                                        <td>
                                            <a
                                                class="btn btn-primary btn-sm"
                                                href="{{ route('customer.bookings.show', $booking->transaction_id) }}"
                                            >{{ __('View') }}</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td
                                        class="text-center"
                                        colspan="5"
                                    >{{ __('No bookings!') }}</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                {!! $bookings->links(HotelHelper::viewPath('partials.pagination')) !!}
            </div>
        </div>
    </div>
@stop
