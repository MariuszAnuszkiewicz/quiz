$(document).ready(function() {

    var scrollTop = '';
    var newHeight = '100';

    $(window).on('scroll', function () {
        scrollTop = $(window).scrollTop();
        newHeight = scrollTop + 100;
    });

    $('.btn-secondary').click(function (e) {
        e.stopPropagation();

        if (jQuery(window).width() < 767) {
            $(this).after($(".content-table"));
            $('.content-table').show();
            $('html, body').animate({
                scrollTop: $('.content-table').offset().top
            }, 500);
        } else {
            $('.content-table').css('top', newHeight).show();
        }
    });

    $('.btn-close').click(function (e) {
        $('.content-table').hide();
    });

    $('.content-table').click(function (e) {
        e.stopPropagation();
    });
});
