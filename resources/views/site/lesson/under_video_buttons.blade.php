@if(Auth::user())
    <button class="btn-success button_copy_link" id="pushLike"
            data-user-push="{{ $userPushLike }}"
            data-id="{{$currentLesson->id}}"
            data-token="{{ csrf_token() }}"
            title="@lang('site.lesson.push_like')"><span class="oi oi-thumb-up"
                   @if($userPushLike == 1) style="color:blue;" @endif>
        </span>&nbsp; {{ $currentLesson->data->good_rang }}
    </button>

    <button class="btn-danger button_copy_link" id="pushDislike"
            data-id="{{$currentLesson->id}}"
            data-user-push="{{ $userPushDislike }}"
            data-token="{{ csrf_token() }}"
            title="@lang('site.lesson.push_dislike')"
            @if($userPushDislike == 1) style="color:blue;" @endif>
        <span class="oi oi-thumb-down"></span>&nbsp; {{ $currentLesson->data->bad_rang }}
    </button>

    <button class="btn-success button_copy_link" disabled title="@lang('site.lesson.views')"><span
            class="oi oi-eye"></span>&nbsp; {{ $currentLesson->data->views }}
    </button>

    <button class="btn-success button_copy_link" disabled title="@lang('site.lesson.favorite')">
        <span class="oi oi-pin"></span>
    </button>

@else
    <h6>Зарегестрируйтесь или зайдите на сайт для возможности взаимодействовать и комментировать</h6>

    <button class="btn-success button_copy_link" disabled title="@lang('site.lesson.push_like')">
        <span class="oi oi-thumb-up"></span>&nbsp; {{ $currentLesson->data->good_rang }}
    </button>

    <button class="btn-danger button_copy_link" disabled title="@lang('site.lesson.push_dislike')">
        <span class="oi oi-thumb-down"></span>&nbsp; {{ $currentLesson->data->bad_rang }}
    </button>

    <button class="btn-success button_copy_link" disabled title="@lang('site.lesson.views')"><span
            class="oi oi-eye"></span>&nbsp; {{ $currentLesson->data->views }}
    </button>

    <button class="btn-success button_copy_link" disabled title="@lang('site.lesson.favorite')">
        <span class="oi oi-pin"></span>
    </button>


@endif

<script src="{{ asset('js/lessons/button.js') }}" type="text/javascript"></script>

