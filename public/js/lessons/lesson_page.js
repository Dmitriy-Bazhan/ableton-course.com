$('.list_lessons').hide();

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
        if(array[i] == ' ' + i + '=show')
        {
            $(div).show();
            $(div).attr('data-view', 'show');
        }
        if(array[i] == ' ' + i + '=hide')
        {
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

$('.choose_your_lesson').click(function (event) {
    // event.preventDefault();
    var id = $(this).attr('data-id');
    $('.choose_your_lesson').attr('style', 'color:#f5d3b3');
    $(this).attr('style', 'color:#afdbf5');

    $.ajax({
        method: 'post',
        url: 'lesson_ajax',
        dataType: 'json',
        data: {
            _token: $(this).data('token'),
            id: $(this).data('id'),
        },
        success: function (data) {

            $('#remove_block').html(data.response);
        },
        error: function (errorThrown) {
            console.log(errorThrown);
        }
    });

});


