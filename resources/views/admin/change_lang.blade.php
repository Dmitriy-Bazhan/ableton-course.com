<script>

    $('#ru').hide();
    $('#ua').hide();
    $('#en').show();

    $('.change_lang').click(function (event) {
        event.preventDefault();
        var div = '#' + $(this).attr('data-lang');
        if (div == '#en') {
            var div1 = '#ru';
            var div2 = '#ua';
        } else if (div == '#ru') {
            var div1 = '#en';
            var div2 = '#ua';
        } else {
            var div1 = '#en';
            var div2 = '#ru';
        }

        $(div).show();
        $(div1).hide();
        $(div2).hide();
    });

</script>
