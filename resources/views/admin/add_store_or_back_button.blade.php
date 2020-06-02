<div style="float:right;">

    <button class="btn-success store_button">

        Сохранить

    </button>

    <a href="{{ url('admin/' . $page) }}">

    <button class="btn-secondary">

        Отмена

    </button>

    </a>

</div>

<br>

<hr>

<script>

    $('.store_button').click(function () {
        $('#form').submit();
    });

</script>
