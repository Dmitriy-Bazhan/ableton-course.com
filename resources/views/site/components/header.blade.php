<nav class="navbar navbar-expand-lg navbar-dark shadow-sm head fixed-top" style="background-color: #6d6a80;">

    <a class="navbar-brand" @if($page_name != '/') href="{{ url_with_locale('/') }}" @endif>

        <img class="micro_logo" src=" {{ asset('img/ava/icons8-electronic-music-96.png') }}">

        <span class="header_site_name">Ableton Live tutorial course</span>

    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

        <span class="navbar-toggler-icon"></span>

    </button>

    <div class="collapse navbar-collapse" id="collapsibleNavbar">

        <div class="col-md-6">

            <ul class="nav navbar-nav">

                <li class="nav-item">

                    <a class="nav-link @if($page_name == 'lesson') disabled @endif"
                       href=" {{ route('lesson') }}">@lang('site.header.lessons')</a>

                </li>

                <li class="nav-item">

                    <a class="nav-link @if($page_name == 'forum') disabled @endif"
                       href=" {{ route('forum') }}">@lang('site.header.forum')</a>

                </li>

                <li class="nav-item">

                    <a class="nav-link @if($page_name == 'blog') disabled @endif"
                       href="{{ route('blog') }}">@lang('site.header.blog')</a>

                </li>

                <li class="nav-item">

                    <a class="nav-link @if($page_name == 'contacts') disabled @endif"
                       href=" {{ route('contacts') }}">@lang('site.header.contacts')</a>

                </li>

                <li class="nav-item">

                    <a class="nav-link @if($page_name == 'chat') disabled @endif"
                       href=" {{ route('chat') }} ">@lang('site.header.chat')</a>

                </li>

                <li class="nav-item">

                    <a class="nav-link @if($page_name == 'about_us') disabled @endif"
                       href=" {{ route('about_us') }} ">@lang('site.header.about_us')</a>

                </li>

            </ul>

        </div>

        <div class="col-md-4">

            <ul class="nav navbar-nav">

                @if(session('message_for_banned_users') == 1)

                    <a class="nav-link disabled" style="color:#940000">@lang('site.header.you_banned')</a>

                @endif

                @guest

                    <li class="nav-item">

                        <a class="nav-link" href="{{ route('login') }}">@lang('site.header.login')</a>

                    </li>

                    @if (Route::has('register'))

                        <li class="nav-item">

                            <a class="nav-link" href="{{ route('register') }}">@lang('site.header.register')</a>

                        </li>

                    @endif

                @else

                    <li class="nav-item">

                        @if(Auth::user()->role == 2 or Auth::user()->role == 4)

                            <a class="nav-link" href=" {{ route('admin') }} ">Admin page</a>

                        @endif

                    </li>

                    <li class="nav-item">

                        <a class="nav-link @if($page_name == 'user_profile') disabled @endif"
                           href=" {{ route('user_profile') }} ">@lang('site.header.you_enter') {{ Auth::user()->name }} </a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            @lang('site.header.logout')

                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">

                            @csrf

                        </form>

                    </li>

                @endguest

            </ul>

        </div>

        <div class="col-md-2">

            <ul class="nav navbar-nav">

                @if($page_name != 'admin')

                    @php($languages = ['en', 'ru', 'ua'])

                    @foreach($languages as $lang)

                        @if ( app()->getLocale() == $lang )

                            <li class="nav-item">

                                <a class="nav-link active">{{ strtoupper($lang) }}</a>

                            </li>

                        @else

                            <li class="nav-item">

                                <a class="nav-link"
                                   href=" {{ url( ($lang == 'en' ? '' : '/'. $lang) . $path) }} ">{{ strtoupper($lang) }}</a>

                            </li>

                        @endif

                    @endforeach

                @endif

            </ul>

        </div>

    </div>

    <script>
        $('.navbar-toggler').click(function () {
            $('#collapsibleNavbar').toggle();
        });
    </script>

</nav>
