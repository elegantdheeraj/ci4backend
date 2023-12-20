var con_message_length = 0;
let mobile_verify = false;
$('#cf_con_message').on('paste input', function () {
    con_message_length = this.value.length;
    if (this.value.length <= 100) {
        $("#remainingC").html(con_message_length);
    } else if(this.value.length > 100) {
        $("#remainingC").html('100 + ');
    }
});
$(".contact_required_field").focus(function () {
    $(this).removeClass('form_error');
});
$('#cf_f_name, #cf_l_name').on('input',function() {
    this.value = this.value.replace(/[^A-Za-z]/g, '').replace(/(\..*?)\..*/g, '$1');
});
$('#contactForm #cf_mobile').on('input paste',function() {
    mobile_verify = false;
    $(this).val($(this).val().replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1'));
    if($(this).val().length == 10) {
        $("#contactForm .verify_mobile_area").html('<button type="button" class="btn btn-sm btn-primary" id="contact_mobile_verify_btn">Verify</button>');
    } else {
        if(!mobile_verify) {
            $("#contactForm .verify_mobile_area").html(''); 
        } 
    }
});
$("#mobile_otp").on('input', function() {
    $(this).val($(this).val().replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1'));
});
$(".verify_mobile_area").on('click','#contact_mobile_verify_btn',function() {
    $(this).prop('disabled', true).html('<i class="fa fa-circle-o-notch" aria-hidden="true"></i> Processing...');
    sendOtp();
});

$("#contact_otp_verify_btn").click(function() {
    $(this).prop('disabled', true).html('<i class="fa fa-circle-o-notch" aria-hidden="true"></i> Processing...');
    verifyOtp();
});

$('#contactForm').submit(function (e) {
    e.preventDefault();
    let error_check = false;
    for (var i = 0; i < $(".contact_required_field").length; i++) {
        if ($(".contact_required_field").eq(i).val() == '') {
            $(".contact_required_field").eq(i).addClass('form_error');
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
    if (!validateEmail($("#cf_email").val())) {
        Swal.fire('Opps sorry!', 'Please check Email', 'error');
        return false;
    }
    let filterMobile = /[6-9]{1}[0-9]{9}/;
    if (!filterMobile.test($("#cf_mobile").val())) {
        Swal.fire('Opps sorry!', 'Please check mobile. It seems not valid', 'error');
        return false;
    }
    if (con_message_length < 100) {
        Swal.fire('Opps sorry!', 'Please provide enough detail so that we could understand your message', 'error');
        return false;
    }
    if(!mobile_verify) {
        Swal.fire('Opps sorry!', 'Please verify mobile number to submit you request', 'error');
        return false;
    }
    $('#contact_us_btn').attr('disabled', true).html('<i class="fa fa-circle-o-notch fa-spin" aria-hidden="true"></i></span> Sending ...');
    var formData = $('form#contactForm').serialize();
    var url = $('#contactForm').attr('action');
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
            $('#contact_us_btn').attr('disabled', false).html('Send Message');
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
function sendOtp($mobile) {
    $("#otp_modal").removeClass('d-none');
    let otp_url = $("#otp_modal").attr('data-getOtpUrl');
    $.ajax({
        url: otp_url,
        data: {'mobile' : $("#contactForm #cf_mobile").val()},
        method: "GET",
        dataType: "JSON",
        success: function (res) {
            if (res.status === false) {
                $("#otp_modal").addClass('d-none');
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    text: res.message,
                    showConfirmButton: true,
                    allowOutsideClick: false
                });
            } else {
                $("#otp_modal .sending_area").hide();
                $("#otp_modal .verify_otp_area").show();
            }
        },
        complete: function () {
            $("#contact_mobile_verify_btn").prop('disabled', false).html('verify');
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
            });
        }
    });
}
function verifyOtp() {
    let otp_url = $("#otp_modal").attr('data-verifyOtpUrl');
    $.ajax({
        url: otp_url,
        data: {'mobile' : $("#contactForm #cf_mobile").val(), 'otp' : $("#otp_modal #mobile_otp").val()},
        method: "GET",
        dataType: "JSON",
        success: function (res) {
            if (res.status === false) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    text: res.message,
                    showConfirmButton: true,
                    allowOutsideClick: false
                });
            } else {
                mobile_verify = true;
                $("#contactForm .verify_mobile_area").html('<input type="hidden" name="is_verify" value="true" /> <button type="button" class="btn btn-sm btn-success" id="mobile_verify_flag">Verifyed</button>'); 
                $("#otp_modal .verify_otp_area").hide();
                $("#otp_modal").hide();
                $("#cf_mobile").prop("readonly", true);
            }
        },
        complete: function () {
            $("#contact_otp_verify_btn").prop('disabled', false).html('Verify Otp');
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
            });
        }
    });
}
function validateEmail($email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return emailReg.test($email);
}
$(".model_close_cbtn").click(function() {
    $("#otp_modal").addClass('d-none');
});

