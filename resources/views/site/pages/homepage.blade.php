@extends('site.layouts.layout')

@section('content')

    <link href="{{asset('css/homepage.css')}}" rel="stylesheet">

    <div class="row justify-content-center">

        <img class="homepage_title_logo" src=" {{ asset('img/ava/icons8-electronic-music-100-1.png') }}">

    </div>

    <div class="row justify-content-center">

        <span><h3>@lang('site.homepage.greeting')</h3></span>

    </div>

    <hr>

    <div class="row justify-content-center">

        <span><h3>@lang('site.homepage.new_items')</h3></span>

    </div>

    <hr>

    <div class="row justify-content-center" style="width: 97%; margin-left: 1.5%">

        @foreach($lastItems as $item)

            <div class="col-md-4" style="padding: 10px;">

                <a data-href="{{ url_with_locale('/lesson?id=' . $item->id) }}" disabled="">

                    <div class="homepage_link new_item">

                        @if(isset($item->image_small) && file_exists('storage/image_small/' . $item->image_small))

                            <img class="new_img" src="{{ asset('storage/image_small/' . $item->image_small) }}">

                        @else

                            <img class="new_img" src="{{ asset('img/ava/icons8-electronic-music-100-1.png') }}">

                        @endif

                        <p class="new_span">{{ $item->data->name }}</p>

                        <p class="new_span">{{ $item->data->description }}</p>

                    </div>

                </a>

            </div>

        @endforeach

    </div>

    <hr>

    <div class="row justify-content-center">

        <span><h3>@lang('site.homepage.popular_lesson')</h3></span>

    </div>

    <hr>

    <div class="row justify-content-center" style="width: 97%; margin-left: 1.5%">

        @foreach($popularLessons as $lesson)

            <div class="col-md-4" style="padding: 10px;">

                <a data-href="{{ url_with_locale('/lesson?id=' . $lesson->lesson->id) }}">

                    <div class="homepage_link popular_lessons">

                        @if(isset($lesson->lesson->image_small) && file_exists('storage/image_small/' . $lesson->lesson->image_small))

                            <img class="popular_img"
                                 src="{{ asset('storage/image_small/' . $lesson->lesson->image_small) }}">

                        @else

                            <img class="popular_img" src="{{ asset('img/Ableton_Live_Suite10-1.jpg') }}">

                        @endif

                        <p class="popular_span">{{ $lesson->name }}</p>

                        <p class="popular_span">{{ $lesson->description }}</p>

                    </div>

                </a>

            </div>

        @endforeach

    </div>

    <script src="{{ asset('js/homepage.js') }}" type="text/javascript" defer></script>

@endsection
