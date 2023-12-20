$(".lspList .item").click(function (e) {
  e.stopPropagation();
  if ($(this).hasClass('active')) {
    $(this).removeClass('active').find(".listDiscription").toggle();
  } else {
    $(".lspList .item.active").find(".listDiscription").toggle();
    $(".lspList .item").removeClass('active');
    $(this).addClass('active').find(".listDiscription").toggle();
  }
});

//---------------Feedback Form------------------------------//

$(document).ready(function () {
  const stars = $(".stars i");

  stars.on("click", function () {
    const selectedIndex = $(this).index();
    $("#rading").val(selectedIndex + 1);
    stars.each(function (index) {
      if (index <= selectedIndex) {
        $(this).addClass("active");
      } else {
        $(this).removeClass("active");
      }
    });
  });
});
var con_message_length = 0;
$('#cf_con_message').on('paste input', function () {
  con_message_length = this.value.length;
  if (this.value.length <= 100) {
    $("#remainingC").html(con_message_length);
  } else if (this.value.length > 100) {
    $("#remainingC").html('100 + ');
  }
});

$("#ratingForm").submit(function (e) {
  e.preventDefault();
  // if (!$("#cf_con_message").val()) {
  //   $("#cf_con_message").addClass('form_error');
  //   Swal.fire(
  //     'Are You Miss?',
  //     'Please fill required field data',
  //     'question'
  //   );
  //   return false;
  // }
  // if (con_message_length < 100) {
  //   Swal.fire('Opps sorry!', 'Please provide enough detail so that we could understand your message', 'error');
  //   return false;
  // }
  $('#feed_submit_btn').attr('disabled', true).html('<i class="fa fa-circle-o-notch fa-spin" aria-hidden="true"></i></span> Submitting ...');
  var formData = $('form#ratingForm').serialize();
  var url = $('#ratingForm').attr('action');
  $.ajax({
    url: url+"feeds/store",
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
            window.location.href = url;
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

