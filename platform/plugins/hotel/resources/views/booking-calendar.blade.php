@extends(BaseHelper::getAdminMasterLayoutTemplate())

@section('content')
    {!! do_action('booking_reports_before_component_render') !!}

    <calendar-booking-reports-component
        v-cloak
        events-url="{{ route('booking.reports.records.index') }}"
    >
        <template v-slot:title>
            {{ trans('plugins/hotel::booking.calendar') }}
        </template>

        <template v-slot:event="{ booking }">
            <x-core::modal
                id="view-booking-event"
                type="info"
                v-if="booking"
                :title="trans('plugins/hotel::booking.name')"
                size="lg"
            >
                <div v-html="booking"></div>

                <x-slot name="footer">
                    <x-core::button data-bs-dismiss="modal">
                        {{ trans('core/base::forms.cancel') }}
                    </x-core::button>
                    <x-core::button
                        tag="a"
                        href="#"
                        target="_blank"
                        id="view-booking-event-link"
                        color="primary"
                    >
                        {{ trans('core/base::forms.edit') }}
                    </x-core::button>
                </x-slot>
            </x-core::modal>
        </template>

        <template v-slot:loading>
            @include('core/base::elements.loading')
        </template>
    </calendar-booking-reports-component>

    {!! do_action('booking_reports_after_component_render') !!}
@endsection
