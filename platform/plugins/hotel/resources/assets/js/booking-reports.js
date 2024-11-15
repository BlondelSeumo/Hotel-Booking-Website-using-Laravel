import CalendarBookingReportsComponent from './components/CalendarBookingReportsComponent.vue'

if (typeof vueApp !== 'undefined') {
    vueApp.booting((vue) => {
        vue.component('calendar-booking-reports-component', CalendarBookingReportsComponent)
    })
}
