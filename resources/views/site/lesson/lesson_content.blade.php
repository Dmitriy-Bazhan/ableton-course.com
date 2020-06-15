<h3>{{ $currentLesson->data->name }}</h3>

@php($lang = app()->getLocale())

<div class="row">

    <div class="col-lg-9">

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

    @php($langLink = $lang != 'en' ? $lang . '/' : '')
    <span id="copy_body"
          class="lesson_link">{{ 'http://ableton-course.com/'. $langLink . 'lesson?id=' . $currentLesson->id }}</span>
    <button onclick="copyLink('#copy_body')"
            class="btn-primary button_copy_link">@lang('site.lesson.copy_link')</button>

</div>

<br>

{{--@if(Auth::check())--}}

    <div id="app">
        <chatbox-component comments='@json($comments)'></chatbox-component>
    </div>


{{--@else--}}



{{--@endif--}}

<script>
    (function(){
        var data = "<chatbox-component comments='@json($comments)'></chatbox-component>";
        $('#app').html(data);
    }());

</script>










