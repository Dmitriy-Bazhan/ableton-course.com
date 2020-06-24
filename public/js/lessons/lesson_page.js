(function () {
    var current_lesson = $('#aside_menu').attr('data-current-lesson');
    var current_div = 'div[data-current-lesson-show = ' + current_lesson + ']';
    $(current_div).show();
    $(current_div).attr('data-view', 'show');
}());

(function () {
    var array = document.cookie.split(";");
    array.sort();
    for (let i = 0; i < array.length; i++) {
        var div = '#list_lessons_' + i;
        if (array[i] == ' ' + i + '=show') {
            $(div).show();
            $(div).attr('data-view', 'show');
        }
        if (array[i] == ' ' + i + '=hide') {
            $(div).hide();
            $(div).attr('data-view', 'hide');
        }
    }
}());

$('#category_list').on('click', '#category_list_category', function () {
    var number = $(this).attr('data-list');
    var div = '#list_lessons_' + number;
    if ($(div).attr('data-view') == 'hide') {
        var cook = number + '=show';
        document.cookie = cook;
        $(div).show();
        $(div).attr('data-view', 'show');
    } else {
        var cook = number + '=hide';
        document.cookie = cook;
        $(div).hide();
        $(div).attr('data-view', 'hide');
    }
});

jQuery(document).ready(function ($) {
    $('#video_lesson_div').iframeTracker({
        blurCallback: function () {

            $.ajax({
                method: 'post',
                url: 'user_start_video',
                dataType: 'json',
                data: {
                    _token: $('.video_player').data('token'),
                    id: $('.video_player').data('id'),
                },
                success: function () {
                    console.log('Him pushing');
                },
                error: function (errorThrown) {
                    console.log(errorThrown);
                }
            });
        }
    });
});




