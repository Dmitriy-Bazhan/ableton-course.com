<nav class="navbar navbar-expand-md bg-transparent navbar-dark">

    <a class="navbar-brand" @if($page_name != '/') href="{{ url_with_locale('/') }}" @endif>

        <img class="micro_logo" src=" {{ asset('img/ava/icons8-electronic-music-96.png') }}">

        <span class="header_site_name">Ableton Live tutorial course</span>

    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">

        <span class="navbar-toggler-icon"></span>

    </button>

    <div class="collapse navbar-collapse" id="collapsibleNavbar">

        <div class="col-9">

            <ul class="navbar-nav">

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

                    <a class="nav-link @if($page_name == 'about_us') disabled @endif"
                       href=" {{ route('about_us') }} ">@lang('site.header.about_us')</a>

                </li>

            </ul>

        </div>

        <div class="col-2">

            <ul class="navbar-nav">

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

        <div class="col-1">

            <ul class="navbar-nav">

                @if($page_name != 'admin')

                    @php($languages = ['en', 'ua', 'ru'])

                @else

                    @php($languages = [])

                @endif

                @foreach($languages as $lang)

                    @if ( app()->getLocale() == $lang )

                        <li class="nav-item">

                            <a class="nav-link active">{{ strtoupper($lang) }}</a>

                        </li>

                    @else

                        <li class="nav-item">

                            @php($prefix = $lang == 'en' ? '' : '/'. $lang)

                            <a class="nav-link" href=" {{ url( $prefix . $path) }} ">{{ strtoupper($lang) }}</a>

                        </li>

                    @endif

                @endforeach

            </ul>

        </div>

    </div>

</nav>
