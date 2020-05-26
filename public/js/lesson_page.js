
$('.list_lessons').hide();

(function(){
    var current_lesson = $('#aside_menu').attr('data-current-lesson');
    var current_div = 'div[data-current-lesson-show = ' + current_lesson + ']';
    $(current_div).show();
    $(current_div).attr('data-view','show');
}());

$('#category_list').on('click','#category_list_category', function(){

    var number = $(this).attr('data-list');
    var div = '#list_lessons_' + number;

    if($(div).attr('data-view') == 'hide')
    {
        $(div).show();
        $(div).attr('data-view','show');
    }else
        {
            $(div).hide();
            $(div).attr('data-view','hide');
        }

});
