@extends('site.layouts.layout')

@section('content')

    <h3>@lang('site.forum.name_page')</h3>

    {{--    <div class="video_player">--}}

    {{--        <div id="player">For player</div>--}}

    {{--    </div>--}}

    {{--    <script src="{{ asset('js/script_en.js') }}" type="text/javascript"></script>--}}
    {{--    <script src="{{ asset('js/lesson_page.js') }}" type="text/javascript"></script>--}}



    <script>
        let countries = [];
        countries[0] = 'Canada';
        countries[1] = 'USA';
        countries[2] = 'France';
        countries[3] = 'Italy';
        countries[5] = 'Argentina';

        sortCountries(countries);

        function sortCountries(countries) {
            var sum = '';
            var a = '';
            var temp = JSON.parse(JSON.stringify(countries));
            temp.sort();

            for (let i = 0; i < temp.length; i++) {
                if (temp[i] === null) {
                    continue;
                }
                for (let j = 0; j < countries.length; j++) {
                    if (temp[i] === countries[j]) {
                        a = j + ':\'' + countries[j] + '\'; ';
                    }
                }
                sum += a;
            }
            console.log(sum.slice(0,-2));
        };

    </script>



@endsection
