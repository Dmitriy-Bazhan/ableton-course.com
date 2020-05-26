@extends('site.layouts.layout')

@section('content')

    <div class="row">

        <div class="col-lg-12">

            <h3>Админка</h3>

        </div>

    </div>

    <div class="container-fluid">

        <div class="row">

            @include('admin.left_aside_menu')

            <div class="col-lg-10">

                @include('admin.' . $page)

            </div>

        </div>

    </div>

@endsection
