Echo.channel('channel')
    .listen('ChatMessageSend', (e) => {
        console.log(e.message);
        console.log(e);
        let date = new Date();
        let timestamp = date.getFullYear() + '-' + (date.getMonth() + 1) + '-' + date.getDate() + ' ' + date.getHours() + ':' + date.getMinutes() + ':' + date.getSeconds();
        var html = '<div class="message">' +
            '<div class="div_date_message"><span class="date_message">' + timestamp + '</span></div>' +
            '<div class="message_div1">' +
            '<span class="span_message_vue">' + e.message + '</span>' +
            '</div><br></div>';
        $('#start').after(html);
    });

var socketId = Echo.socketId();

$('#send_chat_message').click(function(event){
    event.preventDefault();

    let data = $('#input_message').val();
    $('#input_message').val(null);

    $.ajax({
        method: 'post',
        url: '/chat/message',
        // dataType: 'json',
        data: {
            _token: $(this).data('token'),
            message: data,
        },
        success: function (data) {
            console.log('success');
        },
        error: function (errorThrown) {
            console.log(errorThrown);
        }
    });
});


