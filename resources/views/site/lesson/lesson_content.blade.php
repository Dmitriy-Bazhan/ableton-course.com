<h3 id="up">{{ $currentLesson->data->name }}</h3>

<div class="row">

    <div class="col-lg-9 col-mg-9">

        @if(isset($currentLesson->data->video) && !is_null($currentLesson->data->video))

            <div class="video_player">

                <iframe width="100%"
                        height="655px"
                        src="{{ str_replace('watch?v=','embed/',$currentLesson->data->video) }}"
                        frameborder="0"
                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>

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

<div style="margin-left: 5%;" id="under_video_buttom">

    @include('site.lesson.under_video_buttons')

</div>

<br>

@if(Auth::check())

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script>

    <div id="app">
        <chatbox-component comments='@json($comments)'></chatbox-component>
    </div>

@else

    <div class="col-lg-9 lesson_comments_menu">

        <div class="lesson_comments_menu_scroll" id="block_comments">

            @foreach($comments as $comment)

                <div class="message">

                    <div class="div_date_message">

                        <span class="date_message"> {{ $comment['created_at'] }} </span>

                    </div>

                    <div class="message_div1">

                <span
                    class="span_message_vue"> {!! $comment['body'] !!}</span>

                    </div>

                    <br>

                </div>

            @endforeach

        </div>

    </div>

@endif

<a href="#up" class="button_copy_link" style="margin-left: 75%;"><span class="oi oi-data-transfer-upload"></span></a>

{{--<script>--}}
{{--    var block = document.getElementById('block_comments');--}}
{{--    block.scrollTop = block.scrollHeight;--}}
{{--</script>--}}












