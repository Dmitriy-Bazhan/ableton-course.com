$(document).ready(function () {

    //Default hidden lists
    (function () {
        $('.list_lessons').hide();
    }());

    //Show opened or closed lists with lessons
    (function () {
        var array = document.cookie.split(";");
        for (let i = 0; i < array.length + 1; i++) {
            var div = '#list_lessons_' + i;
            var cook = getCookie(i);
            if (cook == 'show') {
                $(div).show();
                $(div).attr('data-view', 'show');
            }
            if (cook == 'hide') {
                $(div).hide();
                $(div).attr('data-view', 'hide');
            }
        }
    }());

    //Show list with current lesson
    (function () {
        var current_lesson = $('#aside_menu').attr('data-current-lesson');
        var current_div = 'div[data-current-lesson-show = ' + current_lesson + ']';
        $(current_div).show();
        $(current_div).attr('data-view', 'show');
    }());

    //I put and get in cookie vars about opened or closed list with lessons
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

    //Onload video on page and control dimensions of video block and under video buttons
    (function () {
        $('.video_player').load('../html/lessons/lesson_video_player.html', function(){
            var src = $('.video_player').data('src');
            $('iframe').attr('src', src);
        });

        setTimeout(
            function(){
                $('iframe').height($('iframe').width() / 1.6);
                $('#aside_menu').height($('iframe').height());
                $('#under_video_buttom').width($('iframe').width());

                // Views counter
                $('#video_lesson_div').iframeTracker({
                    blurCallback: function () {
                        var check;
                        if(check == 1){
                            return;
                        }
                        $.ajax({
                            method: 'post',
                            url: 'user_start_video',
                            dataType: 'json',
                            data: {
                                _token: $('.video_player').data('token'),
                                id: $('.video_player').data('id')
                            },
                            success: function () {
                                check = 1;
                                console.log('Views increment :)');
                            },
                            error: function (errorThrown) {
                                console.log(errorThrown);
                            }
                        });
                    }
                });
            }, 100
        );

        $(window).resize(function () {
            $('iframe').height($('iframe').width() / 1.6);
            $('#aside_menu').height($('iframe').height());
            $('#under_video_buttom').width($('iframe').width());
        });
    }());

    //This function returns value from cookie
    function getCookie(name) {
        var cookie = " " + document.cookie;
        var search = " " + name + "=";
        var setStr = null;
        var offset = 0;
        var end = 0;
        if (cookie.length > 0) {
            offset = cookie.indexOf(search);
            if (offset != -1) {
                offset += search.length;
                end = cookie.indexOf(";", offset);
                if (end == -1) {
                    end = cookie.length;
                }
                setStr = unescape(cookie.substring(offset, end));
            }
        }
        return (setStr);
    }

});
