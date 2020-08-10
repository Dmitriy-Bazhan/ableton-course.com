@extends('site.layouts.layout')

@section('content')

    <link href="{{ asset('css/lessons.css') }}" rel="stylesheet">
    <script src="{{ asset('js/iframeTracker-jquery-master/src/jquery.iframetracker.js') }}" type="text/javascript"
            defer></script>

    <div class="container-fluid">

        <div class="row">

            <div class="col-12">

                <h3>@lang('site.lesson.name_page')</h3>

            </div>

        </div>

    </div>

    <div class="container-fluid">

        <div class="row">

            <div class="col-lg-2 lesson_aside_menu" id="aside_menu"
                 data-current-lesson="{{ $currentLesson->category_id }}">

                <ul class="navbar-nav" id="category_list">

                    @foreach($categories as $list_key => $category)

                        <li class="nav-item">

                            <div class="lessons_aside_menu_category_name">

                                <a class="nav-link" style="color:#f5d3b3" id="category_list_category"
                                   data-list="{{ $list_key }}"><span>&nbsp;</span>
                                    {{ $category->data->name }}
                                </a>

                            </div>

                            <div id="list_lessons_{{ $list_key }}" class="list_lessons" data-view="hide">

                                <ul style="list-style-type:none;">

                                    @foreach($category->lesson as $key => $lesson)

                                        <li>

                                            <div class="lessons_aside_menu_lesson_name">

                                                @if($lesson->id == $currentLesson->id)

                                                    <script>
                                                        $('#list_lessons_{{ $list_key }}')
                                                            .attr('data-current-lesson-show', {{ $currentLesson->category_id }} );
                                                    </script>

                                                    <a class="nav-link choose_your_lesson"
                                                       data-id="{{ $lesson->id }}"
                                                       data-token="{{ csrf_token() }}"
                                                       style="color:#afdbf5">
                                                       <span>&nbsp;</span>
                                                       {{ $category->lesson[$key]->data->name }}
                                                    </a>

                                                @else

                                                    <a class="nav-link choose_your_lesson"
                                                       href=" {{ url_with_locale('/lesson?id=' . $lesson->id) }}"
                                                       data-id="{{ $lesson->id }}"
                                                       data-token="{{ csrf_token() }}"
                                                       style="color:#f5d3b3">
                                                       <span>&nbsp;</span>
                                                       {{ $category->lesson[$key]->data->name }}
                                                    </a>

                                                @endif

                                            </div>

                                        </li>

                                    @endforeach

                                </ul>

                            </div>

                        </li>

                    @endforeach

                </ul>

            </div>

            <div class="col-lg-10" id="remove_block">

                @include('site.lesson.lesson_content')

            </div>

        </div>

    </div>

    <script src="{{ asset('js/lessons/lesson_page.js') }}" type="text/javascript"></script>

@endsection
