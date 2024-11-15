import CalendarModalComponent from './components/CalendarModalComponent'

if (typeof vueApp !== 'undefined') {
    vueApp.booting((vue) => {
        vue.component('calendar-modal-component', CalendarModalComponent)
    })
}
