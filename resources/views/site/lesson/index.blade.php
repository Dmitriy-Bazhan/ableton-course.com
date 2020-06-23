@extends('site.layouts.layout')

@section('content')

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

                            <a class="nav-link" style="color:#f5d3b3" id="category_list_category"
                               data-list="{{ $list_key }}">
                                <i class="fas fa-calculator"></i>
                                {{ $category->data->name }}
                            </a>

                            <div id="list_lessons_{{ $list_key }}" class="list_lessons" data-view="hide">

                                <ul>
                                    @foreach($category->lesson as $key => $lesson)

                                        <li>

                                            @if($lesson->id == $currentLesson->id)

                                                <script>
                                                    $('#list_lessons_{{ $list_key }}')
                                                        .attr('data-current-lesson-show', {{ $currentLesson->category_id }} );
                                                </script>


                                                <a class="nav-link choose_your_lesson"
                                                   data-id="{{ $lesson->id }}"
                                                   data-token="{{ csrf_token() }}"

                                                   style="color:#afdbf5">
                                                    <i class="fas fa-book-open"></i>
                                                    {{ $category->lesson_data[$key]->name }}
                                                </a>

                                            @else

                                                <a class="nav-link choose_your_lesson"
                                                   href=" {{ url_with_locale('/lesson?id=' . $lesson->id) }}"
                                                   data-id="{{ $lesson->id }}"
                                                   data-token="{{ csrf_token() }}"

                                                   style="color:#f5d3b3">
                                                    <i class="fas fa-book-open"></i>
                                                    {{ $category->lesson_data[$key]->name }}
                                                </a>

                                            @endif

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
