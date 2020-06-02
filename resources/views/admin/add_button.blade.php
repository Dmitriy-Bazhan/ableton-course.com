<div style="float:right;">

    <button data-page="{{ $page }}" class="btn-success" id="go_to_add">

        Добавить

    </button>

</div>

<br>

<hr>

<script>

    $('#go_to_add').click(function () {
        var page = $(this).attr('data-page');
        document.location.href = page + '/create';
    });

</script>



