$(document).ready(function () {

    $('#hamburger').click(function () {
        $('#hamburger').toggleClass('hamburgerOpen');
        $('.menuButton').toggleClass('menuButtonOpen');
        if ($(window).scrollTop() < $('.content').offset().top) {
            $('html, body').animate({
                scrollTop: $(".content").offset().top
            }, 1000);
        }
    });

    var stickyNavTop = $('nav').offset().top;
    var stickyNav = function () {
        var scrollTop = $(window).scrollTop();
        if (scrollTop > stickyNavTop) {
            if ($(window).width() > 1060) {
                $('#navList, .part2').addClass('Sticky');
                $('.menuButton').addClass('menuButtonSticky');
                $('.part1').css('display', "none");
                $('#navList > p').css('display', "flex");
            }
            $('nav').addClass('stickynav');
            $('.buttonHolder > p').css("display", "flex");
        } else {
            if ($(window).width() > 1060) {
                $('#navList, .part2').removeClass('Sticky');
                $('.menuButton').removeClass('menuButtonSticky');
                $('.part1').css('display', "flex");
                $('#navList > p').css('display', "none");
            }
            $('nav').removeClass('stickynav');
            $('.buttonHolder > p').css("display", "none");
        }
    };

    stickyNav();
    $(window).scroll(function () {
        stickyNav();
    });

    $('.photo').click(function () {
        var capture = $(this);
        $('.lightbox').append('<img src=' + '"' + capture.attr('src') + '"' + '/>');
        $('.lightbox').css('display', 'flex');
        $(this).addClass('photoBig');

        $('.lightbox').click(function () {
            $('.lightbox').css('display', 'none');
            $('.lightbox').empty();
            $('.photo').removeClass('photoBig')
        });
    });
});
