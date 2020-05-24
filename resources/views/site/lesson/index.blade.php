@extends('site.layouts.layout')

@section('content')


    <div class="row">

        <div class="col-12">

            <h3>@lang('site.lesson.name_page')</h3>

        </div>

    </div>

    <div class="container-fluid">

        <div class="row">

            <div class="col-lg-2 lesson_aside_menu">



                @php($lessons = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25])

                <ul class="navbar-nav">

                    @foreach($lessons as $lesson)

                        <li class="nav-item">

                            <a class="nav-link text-white" href="#">
                                <i class="fas fa-book-open"></i>
                                @lang('site.lesson.lesson') {{ $lesson }}
                            </a>

                        </li>

                    @endforeach

                </ul>

            </div>

            <div class="col-lg-10">

                <h3>Lesson 1</h3>

                <img src=" {{ asset('img/speX-big.jpg') }}" style="width: 30%; margin: 10px; float: left;">

                <span class="new_span">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    Aenean id ante id ipsum aliquam elementum et sit amet nunc.</span>
                <span class="new_span">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    Aenean id ante id ipsum aliquam elementum et sit amet nunc.</span>
                <span class="new_span">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    Aenean id ante id ipsum aliquam elementum et sit amet nunc.</span>
                <span class="new_span">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    Aenean id ante id ipsum aliquam elementum et sit amet nunc.</span>
                <span class="new_span">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    Aenean id ante id ipsum aliquam elementum et sit amet nunc.</span>

            </div>

        </div>

    </div>

@endsection
