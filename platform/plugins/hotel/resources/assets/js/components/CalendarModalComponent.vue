<template>
    <slot v-bind="{ form, saveForm }"></slot>
</template>
<script>
export default {
    props: {
        getRoomAvailabilityUrl: {
            type: String,
            default: '',
        },
    },
    data() {
        return {
            form: {
                id: '',
                value: '',
                value_type: 'fixed',
                start_date: '',
                end_date: '',
                enable_person: 0,
                min_guests: 0,
                max_guests: 0,
                active: 0,
                number_of_rooms: 1,
            },
            formDefault: {
                id: '',
                value: '',
                start_date: '',
                end_date: '',
                enable_person: 0,
                min_guests: 0,
                max_guests: 0,
                active: 0,
                number_of_rooms: 1,
            },
            onSubmit: false,
            calendar: null,
        }
    },
    methods: {
        show: function (form) {
            $('#modal-calendar').modal('show')
            this.onSubmit = false

            if (typeof form != 'undefined') {
                this.form = Object.assign({}, form)

                if (form.start_date) {
                    $('.modal-title').text(moment(form.start_date).format('MM/DD/YYYY'))
                }
            }
        },
        hide: function () {
            $('#modal-calendar').modal('hide')
            this.form = Object.assign({}, this.formDefault)
        },
        saveForm: function () {
            let _self = this

            if (this.onSubmit) {
                return
            }

            if (!this.validateForm()) {
                return
            }

            $('#modal-calendar').find('.btn-primary').addClass('button-loading')

            this.onSubmit = true
            $.ajax({
                url: this.getRoomAvailabilityUrl,
                data: this.form,
                dataType: 'json',
                method: 'POST',
                success: (res) => {
                    if (!res.error) {
                        if (this.calendar) {
                            this.calendar.refetchEvents()
                        }
                        _self.hide()
                        Botble.showSuccess(res.message)
                    } else {
                        Botble.showError(res.message)
                    }
                    _self.onSubmit = false
                    $('#modal-calendar').find('.btn-primary').removeClass('button-loading')
                },
                error: () => {
                    _self.onSubmit = false
                    $('#modal-calendar').find('.btn-primary').removeClass('button-loading')
                },
            })
        },
        validateForm: function () {
            if (!this.form.start_date) {
                return false
            }

            return this.form.end_date
        },
    },
    created: function () {
        let _self = this
        this.$nextTick(function () {
            $(_self.$el).on('hide.bs.modal', function () {
                this.form = Object.assign({}, this.formDefault)
            })
        })
    },
    mounted() {
        let calendarEl

        calendarEl = document.getElementById('dates-calendar')
        if (this.calendar) {
            this.calendar.destroy()
        }

        this.calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'title',
            },
            navLinks: true, // can click day/week names to navigate views
            editable: false,
            dayMaxEvents: false, // allow "more" link when too many events
            events: {
                url: this.getRoomAvailabilityUrl,
            },
            loading: (isLoading) => {
                if (!isLoading) {
                    $(calendarEl).removeClass('loading')
                } else {
                    $(calendarEl).addClass('loading')
                }
            },
            select: (arg) => {
                this.show({
                    start_date: moment(arg.start).format('YYYY-MM-DD'),
                    end_date: moment(arg.end).format('YYYY-MM-DD'),
                })
            },
            eventClick: (info) => {
                let form = Object.assign({}, info.event.extendedProps)
                form.start_date = moment(info.event.start).format('YYYY-MM-DD')
                form.end_date = moment(info.event.start).format('YYYY-MM-DD')
                this.show(form)
            },
            eventRender: (info) => {
                $(info.el).find('.fc-title').html(info.event.title)
            },
        })

        this.calendar.render()
    },
}
</script>
