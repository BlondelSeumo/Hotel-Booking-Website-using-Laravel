<script>
export default {
    props: {
        eventsUrl: {
            type: String,
            required: true,
        },
    },
    data() {
        return {
            calendarInstance: null,
            booking: null,
            loading: true,
        }
    },

    async mounted() {
        await this.$nextTick()

        if (this.calendarInstance) {
            calendarInstance.destroy()
        }

        if (this.$refs.calendar) {
            this.calendarInstance = new FullCalendar.Calendar(this.$refs.calendar, {
                fixedWeekCount: false,
                headerToolbar: {
                    left: 'title',
                },
                navLinks: true,
                editable: false,
                dayMaxEvents: true,
                events: {
                    url: this.eventsUrl,
                },
                loading: (isLoading) => {
                    this.loading = isLoading
                },
                eventClick: (info) => {
                    this.booking = info.event.extendedProps.detail
                    $('#view-booking-event-link').attr('href', info.event.extendedProps.detailUrl)
                    $('#view-booking-event').modal('show')
                },
            })

            this.calendarInstance.render()
        }
    },
}
</script>

<template>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">
                <slot name="title"></slot>
            </h4>
        </div>

        <div class="card-body" ref="calendar"></div>

        <slot name="loading" v-if="loading"></slot>

        <slot name="event" :booking="booking"></slot>
    </div>
</template>
