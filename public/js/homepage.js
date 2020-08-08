$(document).ready(function () {

    (function(){
        let newItemHeight = $('.new_item').width() / 2;
        $('.new_item').css({'height' : newItemHeight });

        let popularLessonHeight = $('.popular_lessons').width() / 2.5;
        $('.popular_lessons').height(popularLessonHeight);

    }());

    $('a[data-href]').click(function () {
        var link = $(this).data('href');
        document.location.href = link;
    });

    $('.homepage_link').hover(function () {
        $(this).css({'opacity': '0.5'});
    }, function () {
        $(this).css({'opacity': '1'});
    });

});
