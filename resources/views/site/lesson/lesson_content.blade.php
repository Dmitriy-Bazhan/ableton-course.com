<div class="col-lg-10">

    <h3>{{ $currentLesson->data->name }}</h3>

    <div class="row">

        <div class="col-lg-8">

            @if(file_exists('storage/video/' . $currentLesson->data->video . '.mp4'))

                <div class="video_player">

                    <div id="player" data-file="{{ $currentLesson->data->video }}">For player</div>

                </div>

            @else

                <div class="video_not_exists">

                    <img class="homepage_title_logo" style="margin-left:10%;"
                         src=" {{ asset('img/ava/icons8-electronic-music-100.png') }}">
                    <h4>@lang('site.lesson.video_problem_1')</h4>
                    <h4>@lang('site.lesson.video_problem_2')</h4>


                </div>

            @endif

        </div>

        <div class="col-lg-4">


            <h3>@lang('site.lesson.description')</h3>

            <span class="new_span">{{ $currentLesson->data->description }}</span>

            <hr>


            <h3>@lang('site.lesson.similar_lesson')</h3>

            <ul class="navbar-nav">

                @foreach($similarLessons as $similarLesson)

                    <li class="nav-item">

                        <a class="nav-link" href=" {{ url_with_locale('/lesson/' . $similarLesson->id) }}"
                           style="color:#1a8b7a;">{{ $similarLesson->data->name }}</a>

                    </li>

                @endforeach

            </ul>

        </div>

    </div>
    <br>

    <div style="margin-left: 10%;">

        <button class="btn-success">Нравиться</button>

        <button class="btn-success">Избранное</button>

        <button class="btn-primary">@lang('site.lesson.views'){{ $currentLesson->views }}</button>

        <button class="btn-primary">@lang('site.lesson.like'){{ $currentLesson->good_rang }}</button>

        <button class="btn-danger">@lang('site.lesson.not_like'){{ $currentLesson->bad_rang }}</button>

    </div>

    <br>

    <div class="lesson_comments_menu">

        <div class="lesson_comments_menu_scroll">

            @php($lessons = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25])

            <ul class="navbar-nav">

                @foreach($lessons as $lesson)

                    <li class="nav-item">

                        <a class="nav-link text-white" href="#">
                            <i class="fas fa-book-open"></i>
                            Комментарий Комментарий Комментарий Комментарий
                            Комментарий
                            номер :{{ $lesson }}
                        </a>

                    </li>

                @endforeach

            </ul>

        </div>

    </div>

    <script src="{{ asset('js/script.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/lesson_page.js') }}" type="text/javascript"></script>

</div>



