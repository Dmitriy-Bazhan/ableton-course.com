<div class="col-lg-2 lesson_aside_menu">

    <ul class="navbar-nav">

        @foreach($adminList as $key => $item)

            <li class="nav-item">

                <a class="nav-link text-white" href=" {{ route('admin/' . $key) }}">{{ $item }}</a>

            </li>

        @endforeach

    </ul>

</div>

