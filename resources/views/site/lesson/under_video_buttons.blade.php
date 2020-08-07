<div class="row">

    <div class="col-9">
        @if(Auth::check())

            <button style="margin-left: 10%;" class="button_copy_link" id="pushLike"
                    data-user-push="{{ $userPushLike }}"
                    data-id="{{$currentLesson->id}}"
                    data-token="{{ csrf_token() }}"
                    title="@lang('site.lesson.push_like')"><span class="oi oi-thumb-up"
                                                                 @if($userPushLike == 1) style="color:lightgreen;" @endif>
        </span>&nbsp; {{ $currentLesson->data->good_rang }}
            </button>

            <button class="button_copy_link" id="pushDislike"
                    data-id="{{$currentLesson->id}}"
                    data-user-push="{{ $userPushDislike }}"
                    data-token="{{ csrf_token() }}"
                    title="@lang('site.lesson.push_dislike')"
                    @if($userPushDislike == 1) style="color:red;" @endif>
                <span class="oi oi-thumb-down"></span>&nbsp; {{ $currentLesson->data->bad_rang }}
            </button>

            <button class="button_copy_link" disabled title="@lang('site.lesson.views')"><span
                    class="oi oi-eye"></span>&nbsp; {{ $currentLesson->data->views }}
            </button>

            <button class="button_copy_link" id="add_to_favorites"
                    data-id="{{$currentLesson->id}}"
                    data-user-push="{{ $userAddFavorites }}"
                    data-token="{{ csrf_token() }}"
                    title="@lang('site.lesson.favorite')"
                    @if($userAddFavorites == 1) style="color:lightgreen;" @endif>
                <span class="oi oi-pin"></span>
            </button>

        @else
            <h6>@lang('site.lesson.declaration')</h6>

            <button style="margin-left: 5%;" class="button_copy_link" disabled title="@lang('site.lesson.push_like')">
                <span class="oi oi-thumb-up"></span>&nbsp; {{ $currentLesson->data->good_rang }}
            </button>

            <button class="button_copy_link" disabled title="@lang('site.lesson.push_dislike')">
                <span class="oi oi-thumb-down"></span>&nbsp; {{ $currentLesson->data->bad_rang }}
            </button>

            <button class="button_copy_link" disabled title="@lang('site.lesson.views')"><span
                    class="oi oi-eye"></span>&nbsp; {{ $currentLesson->data->views }}
            </button>

            <button class="button_copy_link" disabled title="@lang('site.lesson.favorite')">
                <span class="oi oi-pin"></span>
            </button>

        @endif

    </div>

    <div class="col-3">

        @php($langLink = app()->getLocale() != 'en' ? app()->getLocale() . '/' : '')

        <button onclick="copyLink('#copy_body')"
                class="btn-primary button_copy_link">@lang('site.lesson.copy_link')
        </button>

        <input type="hidden" value="{{'http://ableton-course.com/'. $langLink . 'lesson?id=' . $currentLesson->id }}" id="copy_body">

    </div>

</div>

<script src="{{ asset('js/lessons/button.js') }}" type="text/javascript"></script>
