<div class="nav-item dropdown d-none d-md-flex me-2">
    <button
        class="nav-link px-0"
        data-bs-toggle="dropdown"
        type="button"
        tabindex="-1"
    >
        <x-core::icon name="ti ti-mail" />
        <span class="badge bg-red text-red-fg badge-pill">{{ number_format(count($bookings)) }}</span>
    </button>
    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card">
        <x-core::card>
            <x-core::card.header>
                <x-core::card.title>{!! BaseHelper::clean(trans('plugins/hotel::booking.new_booking_notice', ['count' => count($bookings)])) !!}</x-core::card.title>
                <x-core::card.actions>
                    <a href="{{ route('booking.index') }}">{{ trans('plugins/hotel::booking.view_all') }}</a>
                </x-core::card.actions>
            </x-core::card.header>
            <div
                class="list-group list-group-flush list-group-hoverable overflow-auto"
                style="max-height: 35rem"
            >
                @foreach ($bookings as $booking)
                    <a href="{{ route('booking.edit', $booking->id) }}" class="text-decoration-none">
                        <div class="list-group-item">
                            <div class="row">
                                <div class="col-auto">
                                    <img
                                        class="avatar"
                                        src="{{ \Botble\Base\Supports\Gravatar::image($booking->address->email) }}"
                                        alt="{{ $booking->address->full_name }}"
                                    >
                                </div>
                                <div class="col align-items-center">
                                    <p class="text-truncate mb-2">
                                        {{ $booking->address->full_name }}
                                        <time
                                            class="small text-muted"
                                            title="{{ $createdAt = BaseHelper::formatDateTime($booking->created_at) }}"
                                            datetime="{{ $createdAt }}"
                                        >
                                            {{ $createdAt }}
                                        </time>
                                    </p>
                                    <p class="text-secondary text-truncate mt-n1 mb-0">
                                        {{ implode(' - ', [$booking->address->phone, $booking->address->email]) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            @if (count($bookings) > 10)
                <x-core::card.footer class="text-center border-top">
                    <a href="{{ route('booking.index') }}">{{ trans('plugins/hotel::booking.view_all') }}</a>
                </x-core::card.footer>
            @endif
        </x-core::card>
    </div>
</div>

