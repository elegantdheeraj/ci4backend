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