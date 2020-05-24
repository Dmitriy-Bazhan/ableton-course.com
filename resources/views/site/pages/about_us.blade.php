@extends('site.layouts.layout')

@section('content')

    <h3>@lang('site.about_us.name_page')</h3>

    <div class="row justify-content-center">

        <div class="col-8">

            <a href="#">

                <img class="popular_img" src="{{ asset('img/faces/Serj1.jpg') }}">
                <img class="popular_img" src="{{ asset('img/faces/Dima2.jpg') }}">
                <img class="popular_img" src="{{ asset('img/faces/Serj2.jpg') }}">
                <img class="popular_img" src="{{ asset('img/faces/Dima1.jpg') }}">
            </a>

        </div>

    </div>

    @endsection
