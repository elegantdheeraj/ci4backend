$(".singleService_4").hover(
    function () {
        let imgHolder = $(this).find('.toogle_img');
        let toggle_img = imgHolder.data('altimage');
        imgHolder.attr('src', toggle_img);
    },
    function () {
        let imgHolder = $(this).find('.toogle_img');
        let toggle_img = imgHolder.data('img');
        imgHolder.attr('src', toggle_img);
    }
); $(".singleService_4").hover(
    function () {
        let imgHolder = $(this).find('.toogle_img');
        let toggle_img = imgHolder.data('altimage');
        imgHolder.attr('src', toggle_img);
    },
    function () {
        let imgHolder = $(this).find('.toogle_img');
        let toggle_img = imgHolder.data('img');
        imgHolder.attr('src', toggle_img);
    }
);

//---------------EMI Calculator------------------------------//

$(document).ready(function () {
    // Click event for tab selection
    $('#myTabs a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');

        // Tab indicator functionality
        var tabs = $('.nav-tabs');
        var activeItem = tabs.find('.active');
        var activeWidth = activeItem.innerWidth();
        var itemPos = $(this).position();
        $(".emi_selector").css({
            "left": itemPos.left + "px",
            "width": activeWidth + "px"
        });
    });

    // Initial tab indicator setup
    var tabs = $('.nav-tabs');
    var activeItem = tabs.find('.active');
    var activeWidth = activeItem.innerWidth();
    $(".emi_selector").css({
        "left": activeItem.position().left + "px",
        "width": activeWidth + "px"
    });
});






