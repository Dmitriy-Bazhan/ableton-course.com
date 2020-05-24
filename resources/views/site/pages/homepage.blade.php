@extends('site.layouts.layout')

@section('content')

    <div class="row justify-content-center">

        <img class="homepage_title_logo" src=" {{ asset('img/speX-big.jpg') }}">

    </div>

    <div class="row justify-content-center">

        <span><h3>@lang('site.homepage.greeting')</h3></span>

    </div>

    <hr>

    <div class="row justify-content-center">

        <span><h3>@lang('site.homepage.new_items')</h3></span>

    </div>

    <hr>

    <div class="row">

        <div class="col-4">

            <a href="#">

            <img class="new_img" src="{{ asset('img/speX.jpg') }}">

            <span class="new_span">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean id ante id ipsum aliquam elementum et
                sit
                amet
                nunc. Nulla sed tellus ac eros tincidunt interdum sed ut ligula. Cras convallis dolor non eros
                malesuada,
                eget
                vehicula velit tincidunt. Morbi eget lacus velit. </span>

            </a>

        </div>

        <div class="col-4">

            <a href="#">

                <img class="new_img" src="{{ asset('img/speX.jpg') }}">

                <span class="new_span">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean id ante id ipsum aliquam elementum et
                sit
                amet
                nunc. Nulla sed tellus ac eros tincidunt interdum sed ut ligula. Cras convallis dolor non eros
                malesuada,
                eget
                vehicula velit tincidunt. </span>

            </a>

        </div>

        <div class="col-4">

            <a href="#">

                <img class="new_img" src="{{ asset('img/speX.jpg') }}">

                <span class="new_span">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean id ante id ipsum aliquam elementum et
                sit
                amet
                nunc. Nulla sed tellus ac eros tincidunt interdum sed ut ligula. Cras convallis dolor non eros
                malesuada,
                eget
                vehicula velit tincidunt. Morbi eget lacus velit. </span>

            </a>

        </div>

    </div>

    <hr>


    <div class="row justify-content-center">

        <span><h3>@lang('site.homepage.popular_lesson')</h3></span>

    </div>

    <hr>

    <div class="row">

        <div class="col-4">

            <a href="#">

                <img class="popular_img" src="{{ asset('img/Ableton_Live_Suite10-1.jpg') }}">

                <p class="popular_span">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean id ante id ipsum
                    aliquam elementum et sit
                    amet
                    nunc. Nulla sed tellus ac eros tincidunt interdum sed ut ligula. Cras convallis dolor non eros
                    malesuada,
                    eget
                    vehicula velit tincidunt. </p>

            </a>

        </div>

        <div class="col-4">

            <a href="#">

                <img class="popular_img" src="{{ asset('img/1.jpg') }}">

                <p class="popular_span">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean id ante id ipsum
                    aliquam elementum et sit
                    amet
                    nunc. Nulla sed tellus ac eros tincidunt interdum sed ut ligula. Cras convallis dolor non eros
                    malesuada,
                    eget
                    vehicula velit tincidunt. </p>

            </a>

        </div>

        <div class="col-4">

            <a href="#">

                <img class="popular_img" src="{{ asset('img/Ableton_Live_Suite10-1.jpg') }}">

                <p class="popular_span">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean id ante id ipsum
                    aliquam elementum et sit
                    amet
                    nunc. Nulla sed tellus ac eros tincidunt interdum sed ut ligula. Cras convallis dolor non eros
                    malesuada,
                    eget
                    vehicula velit tincidunt. </p>

            </a>

        </div>

    </div>
@endsection
