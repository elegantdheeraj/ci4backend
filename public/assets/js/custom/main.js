$(".required_field").focus(function () {
    $(this).removeClass('form_error');
});
$("#subscrbe_form #subscriber_mobile").on('input paste', function() {
    $(this).val($(this).val().replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1'));
});
$('#subscrbe_form').submit(function (e) {
    e.preventDefault();
    let error_check = false;
    for (var i = 0; i < $(".required_field").length; i++) {
        if ($(".required_field").eq(i).val() == '') {
            $(".required_field").eq(i).addClass('form_error');
            error_check = true;
        }
    }
    if (error_check) {
        Swal.fire(
            'Are You Miss?',
            'Please fill required field data',
            'question'
        );
        return false;
    }
    if (!validateEmail($("#subscriber_email").val())) {
        Swal.fire('Opps sorry!', 'Please check Email Address', 'error');
        return false;
    }
    let filterMobile = /[6-9]{1}[0-9]{9}/;
    if (!filterMobile.test($("#subscriber_mobile").val())) {
        Swal.fire('Opps sorry!', 'Please check mobile. It seems not valid', 'error');
        return false;
    }
    $('#subscribe_btn').attr('disabled', true).html('<i class="fa fa-circle-o-notch fa-spin" aria-hidden="true"></i></span> Processing ...');
    var formData = $('form#subscrbe_form').serialize();
    var url = $('#subscrbe_form').attr('action');
    $.ajax({
        url: url,
        data: formData,
        method: "POST",
        dataType: "JSON",
        success: function (res) {
            if (res.status === false) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    text: res.message,
                    showConfirmButton: true,
                    allowOutsideClick: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    }
                });
            } else {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    text: res.message,
                    showConfirmButton: true,
                    allowOutsideClick: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    }
                });
            }
        },
        complete: function () {
            $('.form_field').val('');
            $('#subscribe_btn').attr('disabled', false).html('Subscribe now');
        },
        error: function (jqXHR, exception) {
            var msg = '';
            if (jqXHR.status === 0) {
                msg = 'Not connect.\n Verify Network.';
            } else if (jqXHR.status == 404) {
                msg = 'Requested page not found. [404]';
            } else if (jqXHR.status == 500) {
                msg = 'Internal Server Error [500].';
            } else if (exception === 'timeout') {
                msg = 'Time out error.';
            } else if (exception === 'abort') {
                msg = 'Ajax request aborted.';
            } else {
                msg = 'Uncaught Error, Something went wrong Please retry again';
            }
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                text: msg,
                allowOutsideClick: false,
                showConfirmButton: true
            }).then((result) => {
                if (result.isConfirmed) {
                    location.reload();
                }
            });
        }
    });
});
function validateEmail($email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return emailReg.test($email);
}