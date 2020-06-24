function copyLink(element) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(element).html()).select();
    document.execCommand("copy");
    $temp.remove();
}

$('#pushLike').click(function () {

    $.ajax({
        method: 'post',
        url: 'lesson_push_like_ajax',
        dataType: 'json',
        data: {
            _token: $(this).data('token'),
            id: $(this).data('id'),
            push: $(this).data('user-push'),
        },
        success: function (data) {
            $('#under_video_buttom').html(data.response);
        },
        error: function (errorThrown) {
            console.log(errorThrown);
        }
    });

});

$('#pushDislike').click(function () {

    $.ajax({
        method: 'post',
        url: 'lesson_push_dislike_ajax',
        dataType: 'json',
        data: {
            _token: $(this).data('token'),
            id: $(this).data('id'),
            push: $(this).data('user-push'),
        },
        success: function (data) {
            $('#under_video_buttom').html(data.response);
        },
        error: function (errorThrown) {
            console.log(errorThrown);
        }
    });
});

$('#add_to_favorites').click(function () {

    $.ajax({
        method: 'post',
        url: 'lesson_add_to_favorites',
        dataType: 'json',
        data: {
            _token: $(this).data('token'),
            id: $(this).data('id'),
            push: $(this).data('user-push'),
        },
        success: function (data) {
            $('#under_video_buttom').html(data.response);
        },
        error: function (errorThrown) {
            console.log(errorThrown);
        }
    });
});



