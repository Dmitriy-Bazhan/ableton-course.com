$('.list_lessons').hide();

(function () {
    var current_lesson = $('#aside_menu').attr('data-current-lesson');
    var current_div = 'div[data-current-lesson-show = ' + current_lesson + ']';
    $(current_div).show();
    $(current_div).attr('data-view', 'show');
}());

$('#category_list').on('click', '#category_list_category', function () {

    var number = $(this).attr('data-list');
    var div = '#list_lessons_' + number;

    if ($(div).attr('data-view') == 'hide') {
        $(div).show();
        $(div).attr('data-view', 'show');
    } else {
        $(div).hide();
        $(div).attr('data-view', 'hide');
    }

});

$('.choose_your_lesson').click(function (event) {
    event.preventDefault();
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

            $('#remove_block').html(data.response_table);
        },
        error: function (errorThrown) {
            console.log(errorThrown);
        }
    });

});

function copyLink(element) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(element).html()).select();
    document.execCommand("copy");
    $temp.remove();
}

$('#pushLike').click(function() {
    console.log($('#pushLike').attr('data-id'));
    removeButtonBorder($(this));
});


function removeButtonBorder(element) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val(element.html()).select();
    $temp.remove();
    return;
}
