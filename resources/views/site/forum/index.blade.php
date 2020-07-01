@extends('site.layouts.layout')

@section('content')

    <h3>@lang('site.forum.name_page')</h3>

    <div class="container-fluid">

        <div class="row justify-content-center">

            <div class="col-xl-6" style="border: solid 1px red;">

                <h6>@lang('site.forum.declaration')</h6>

            </div>

        </div>

    </div>

    <br>

    <div class="container-fluid">

        <div class="row justify-content-center">

            <div class="col-xl-9" style="border: solid 1px red;">

                <ul>

                    @foreach($forums as $forum)

                        <li>

                            <a href="{{ url_with_locale('/forum/id=' . $forum->id) }}"><h5>{{ $forum->name }}</h5></a>

                        </li>

                    @endforeach

                </ul>

            </div>

        </div>

    </div>

@endsection
