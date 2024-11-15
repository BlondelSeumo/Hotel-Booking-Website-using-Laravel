const RiorelaxTheme = RiorelaxTheme || {}
window.RiorelaxTheme = RiorelaxTheme

toastr.options = {
    positionClass: 'toast-bottom-right',
}

RiorelaxTheme.showError = (message) => {
    toastr.error(message)
}

RiorelaxTheme.showSuccess = (message) => {
    toastr.success(message)
}

RiorelaxTheme.isRtl = () => {
    return document.body.dir === 'rtl'
}

RiorelaxTheme.handleError = (data) => {
    if (typeof data.errors !== 'undefined' && data.errors.length) {
        RiorelaxTheme.handleValidationError(data.errors)
    } else if (typeof data.responseJSON !== 'undefined') {
        if (typeof data.responseJSON.errors !== 'undefined') {
            if (data.status === 422) {
                RiorelaxTheme.handleValidationError(data.responseJSON.errors)
            }
        } else if (typeof data.responseJSON.message !== 'undefined') {
            RiorelaxTheme.showError(data.responseJSON.message)
        } else {
            $.each(data.responseJSON, (index, el) => {
                $.each(el, (key, item) => {
                    RiorelaxTheme.showError(item)
                })
            })
        }
    } else {
        RiorelaxTheme.showError(data.statusText)
    }
}

RiorelaxTheme.handleValidationError = (errors) => {
    let message = ''
    $.each(errors, (index, item) => {
        if (message !== '') {
            message += '<br />'
        }
        message += item
    })
    RiorelaxTheme.showError(message)
}

;(function ($) {
    'use strict'
    $(document).on('submit', '.newsletter-form', function (event) {
        event.preventDefault()
        event.stopPropagation()

        let _self = $(event.target)
        let _btn = _self.find('button[type="submit"]')
        $.ajax({
            type: 'POST',
            cache: false,
            url: _self.closest('form').prop('action'),
            data: new FormData(_self.closest('form')[0]),
            contentType: false,
            processData: false,
            beforeSend: () => {
                _btn.addClass('button-loading')
                _btn.attr('disable')
            },
            success: (res) => {
                if (!res.error) {
                    _self.closest('form').find('input[type=email]').val('')
                    RiorelaxTheme.showSuccess(res.message)
                } else {
                    RiorelaxTheme.handleError(res.message)
                }
            },
            error: (res) => {
                RiorelaxTheme.handleError(res)
            },
            complete: () => {
                if (typeof refreshRecaptcha !== 'undefined') {
                    refreshRecaptcha()
                }
                _btn.removeClass('button-loading')
                _btn.removeAttr('disable')
            },
        })
    })

    initDatePicker()
})(jQuery)

function initDatePicker() {
    if ($('.form-booking .date-picker').length > 0) {
        const date = new Date();
        const today = new Date(date.getFullYear(), date.getMonth(), date.getDate());

        $('.form-booking .date-picker').each(function() {
            const options = {
                autoclose: true,
                startDate: today,
            }

            if ($(this).data('locale')) {
                options.language = $(this).data('locale')
            }

            if ($(this).data('date-format')) {
                options.format = $(this).data('date-format')
            }

            $(this).datepicker(options)
        })
    }
}
