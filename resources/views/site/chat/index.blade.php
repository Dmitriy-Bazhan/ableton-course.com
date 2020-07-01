@extends('site.layouts.layout')

@section('content')

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>

    <div class="container-fluid">

        <div class="row">

            <div class="col-12">

                <h3>@lang('site.chat.name_page')</h3>

            </div>

        </div>

    </div>

    <div class="container-fluid">

        <div class="row justify-content-center">

            @if(Auth()->check())

                <div class="col-9">

                    <form class="form">

                        <h4>@lang('site.chat.send_your_message')</h4>

                        <input id="input_message" class="textarea_in_chat" type="text"
                               name="chat_message">

                        <br>
                        <br>

                        <input class="send_message_in_chat" type="submit" value="Send" id="send_chat_message"
                               data-token="{{ csrf_token() }}">

                    </form>

                </div>

            @else

                <h6>@lang('site.chat.declaration')</h6>

            @endif

        </div>

    </div>

    <br>

    <div class="container-fluid">

        <div class="row justify-content-center">

            <div class="col-lg-9 lesson_comments_menu">

                <div class="lesson_comments_menu_scroll" id="block_comments">

                    <div class="col-9">

                        <h4 id="start"></h4>


                        @foreach($comments as $comment)

                            <div class="message">

                                <div class="div_date_message">

                                    <span class="date_message"> {{ $comment['created_at'] }} </span>

                                </div>

                                <div class="message_div1">

                <span
                    class="span_message_vue"> {!! $comment['comment'] !!}</span>

                                </div>

                                <hr>

                            </div>

                        @endforeach

                    </div>

                </div>

            </div>


            <script src="{{ asset('js/chat/chat.js') }}"></script>

        </div>

    </div>

@endsection
