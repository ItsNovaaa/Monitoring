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

    
    $.ucfirst = function(str) {
        var text = str;
        var parts = text.split(' '),
            len = parts.length,
            i, words = [];
        for (i = 0; i < len; i++) {
            var part = parts[i];
            var first = part[0].toUpperCase();
            var rest = part.substring(1, part.length);
            var word = first + rest;
            words.push(word);
        }
        return words.join(' ');
    };
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
    swal({
      title: msg,
      text: '',
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#dd4b39",
      confirmButtonText: "OK"
    }, function() {
        if ($.isFunction(action)) {
            action();
        } else {
            document.location.href=action;
        }
    });
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
        message: '<i class="icon-spinner4 spinner"></i>',
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