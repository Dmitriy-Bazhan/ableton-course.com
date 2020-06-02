<h3>{{ $currentLesson->data->name }}</h3>

@php($lang = app()->getLocale())

<div class="row">

    <div class="col-lg-9">

        @if(file_exists('storage/video/'. app()->getLocale() . '/'. $currentLesson->data->video))

            <div class="video_player">

                <div id="player{{$lang}}" data-file="{{ $currentLesson->data->video }}" data-lang="{{ $lang . '/' }}">For player</div>

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

    <div class="col-lg-3">

        <h3>@lang('site.lesson.description')</h3>

        <p class="new_span">{{ $currentLesson->data->description }}</p>

        <hr>


        <h3>@lang('site.lesson.similar_lesson')</h3>

        <ul class="navbar-nav">

            @foreach($similarLessons as $similarLesson)

                <li class="nav-item">

                    <a class="nav-link" href=" {{ url_with_locale('/lesson?id=' . $similarLesson->id) }}"
                       style="color:#1a8b7a;">{{ $similarLesson->data->name }}</a>

                </li>

            @endforeach

        </ul>

    </div>

</div>
<br>

<div style="margin-left: 5%;">

    <button class="btn-success button_copy_link" id="pushLike" data-id="{{$currentLesson->id}}"

            title="@lang('site.lesson.push_like')"><span class="oi oi-thumb-up">
        </span>&nbsp; {{ $currentLesson->good_rang }}
    </button>

    <button class="btn-danger button_copy_link" id="pushDislike" title="@lang('site.lesson.push_dislike')">
        <span class="oi oi-thumb-down"></span>&nbsp; {{ $currentLesson->bad_rang }}
    </button>

    <button class="btn-success button_copy_link" disabled title="@lang('site.lesson.views')"><span
            class="oi oi-eye"></span>&nbsp; {{ $currentLesson->views }}
    </button>

    <button class="btn-success button_copy_link" disabled title="@lang('site.lesson.favorite')">
        <span class="oi oi-pin"></span>
    </button>

    @php($langLink = $lang != 'en' ? $lang . '/' : '')
    <span id="copy_body" class="lesson_link">{{ 'http://ableton-course.com/'. $langLink . 'lesson?id=' . $currentLesson->id }}</span>
    <button onclick="copyLink('#copy_body')"
            class="btn-primary button_copy_link">@lang('site.lesson.copy_link')</button>

</div>

<br>

<div class="col-lg-9 lesson_comments_menu">

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

<script src="{{ asset('js/script_en.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/script_ru.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/script_ua.js') }}" type="text/javascript"></script>





