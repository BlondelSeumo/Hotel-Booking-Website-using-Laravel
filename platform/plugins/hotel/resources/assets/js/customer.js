$(document).ready(() => {
    $(document).on('click', '#is_change_password', (event) => {
        console.log(5)
        if ($(event.currentTarget).is(':checked')) {
            $('input[type=password]').closest('.form-group').removeClass('hidden').fadeIn()
        } else {
            $('input[type=password]').closest('.form-group').addClass('hidden').fadeOut()
        }
    })
})
