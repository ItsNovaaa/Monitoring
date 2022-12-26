$(function() {
    $('body').buildForm();
    $('.dropdown-submenu a.dropdown-toggle-submenu').click(function(e) {
        $(this).next('ul').toggle();
        e.stopPropagation();
        e.preventDefault();
    });
    $.extend(true, $.fn.dataTable.defaults, {
        initComplete : function() {
            $('[data-toggle="tooltip"]', this).tooltip();
        }
    });
    if ($('#sidebar a[href="'+window.location.href+'"]')) {
        $('#sidebar a[href="'+window.location.href+'"]').parent().addClass('active');
        $('#sidebar a[href="'+window.location.href+'"]').parent().parent().show();
        $('#sidebar a[href="'+window.location.href+'"]').parent().parent().parent().addClass('expand');
    }
});

$.fn.buildForm = function() {
    $.fn.modal.Constructor.prototype.enforceFocus = function() {};
    $.each(this, function(key, elem) {
        $('[data-input-type="select2"]', elem).each(function(key, elem) {
            var containerCssClass = '';
            if ($(elem).hasClass('form-control-sm')) {
                containerCssClass = 'select2-sm';
            }
            if ($(elem).parents('.dataTables_filter').length == 0) {
                $(elem).css('width', '100%');
            }
            if ($(elem).parents('.bootbox.modal').length == 1) {
                $(elem).select2({
                    dropdownParent: $('.bootbox.modal'),
                    containerCssClass: containerCssClass,
                    dropdownAutoWidth: true
                });
            } else if ($(elem).parents('.modal').length == 1) {
                $(elem).select2({
                    dropdownParent: $('.modal'),
                    containerCssClass: containerCssClass,
                    dropdownAutoWidth: true
                });
            } else {
                $(elem).select2({
                    containerCssClass: containerCssClass,
                    dropdownAutoWidth: true
                });
            }
        });
        $('[data-input-type="number-format"]', elem).each(function(key, elem) {
            var thousand_separator = lang['thousand_separator'];
            if ($(elem).data('thousand-separator') != undefined) {
                if ($(elem).data('thousand-separator') == false) {
                    thousand_separator = '';
                } else {
                    thousand_separator = $(elem).data('thousand-separator');
                    if (thousand_separator === true) {
                        thousand_separator = lang['thousand_separator'];
                    }
                }
            }
            var decimal_separator = lang['decimal_separator'];
            if ($(elem).data('decimal-separator') != undefined) {
                if ($(elem).data('decimal-separator') == false) {
                    decimal_separator = '';
                } else {
                    decimal_separator = $(elem).data('decimal-separator');
                    if (decimal_separator === true) {
                        decimal_separator = lang['decimal_separator'];
                    }
                }
            }
            var precision = 2;
            if ($(elem).data('precision') != undefined ) {
                precision = parseInt($(elem).data('precision'));
            }
            $(elem).number(true, precision, decimal_separator, thousand_separator);
        });
        $('[data-input-type="datepicker"]', elem).each(function(key, elem) {
            if ($(elem).data('end-date')) {
                var endDate = new Date($(elem).data('end-date'));
            } else {
                var endDate = false;
            }

            $(elem).datepicker({
                format : lang['datepicker_format'],
                endDate : endDate,
                enableOnReadonly : false
            });
        });
        $('[data-input-type="timepicker"]', elem).each(function(key, elem) {
            $(elem).timepicker({
                showMeridian: false
            });
        });
        $('[data-input-type="dateinput"]', elem).each(function(key, elem) {
            $(elem).inputmask('datetime', {
                inputFormat: lang['datepicker_format'],
                outputFormat: lang['datepicker_format'],
                inputEventOnly: true
            });
        });
    });
}

function swalConfirm(msg, action) {
    Swal.fire({
        title: msg,
        showCancelButton: true,
        confirmButtonText: 'OK',
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            if ($.isFunction(action)) {
                action();
            } else {
                document.location.href=action;
            }
        }
    })
}



function coalesce(str, to) {
    if (str == null) {
        if (to) {
            return to;
        } else {
            return '';
        }
    } else {
        return str;
    }
}


function toFloat(value) {
    value = parseFloat(value);
    if (!$.isNumeric(value)) {
        return 0;
    } else {
        return value;
    }
}


$.fn.blockUI = function() {
    $(this).block({
        message: '<div class="spinner-border text-primary preload-spinner"></div>',
        overlayCSS: {
            backgroundColor: '#fff',
            opacity: 0.8,
            cursor: 'wait'
        },
        css: {
            border: 0,
            padding: 0,
            backgroundColor: 'transparent'
        }
    })
};

function confirmDialog(title, message, action) {
    Swal.fire({
        icon : 'warning',
        title: title,
        text: message,
        widthAuto: true,
        showCloseButton: true,
        showCancelButton: true,
        buttonsStyling: false,
        allowOutsideClick: false,
        customClass: {
            confirmButton: 'btn btn-outline-success mr-3',
            cancelButton: 'btn btn-outline-danger'
        },
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batalkan'
    }).then((result) => {
        if (result.isConfirmed) {
            if ($.isFunction(action)) {
                action();
            } else {
                document.location.href=action;
            }
        }
    })
}
