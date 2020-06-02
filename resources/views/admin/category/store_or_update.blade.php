@extends('site.layouts.layout')

@section('content')

    <div class="container-fluid">

        <div class="row">

            @include('admin.left_aside_menu')

            <div class="col-lg-10">

            @if (count($errors) > 0)
                <!-- Список ошибок формы -->
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>Все поля обязательны для заполнения!</strong>
                    </div>
                @endif

                @include('admin.add_store_or_back_button')

                <form enctype="multipart/form-data" class="form-group" method="POST"
                      action="{{ $action == 'store' ? url('admin/' . $page) : url('admin/' . $page . '/id=' . $category->id )}}"
                      id="form">

                    {{ csrf_field() }}


                    @if($action == 'update')

                        <input type="hidden" name="category_id" value=" {{ $category->id }}">
                        <input type="hidden" name="_method" value="PUT">

                    @endif

                    <div class="form-group">
                        @if($action == 'update')
                            <div class="row">
                                <div class="col-lg-1">
                                    <label class="control-label">Алиас:</label>
                                </div>
                                <div class="col-lg-11">
                                    @if($errors->has('alias'))
                                        <input type="text" class="form-control input_in_admin" name="alias"
                                               style="border: solid 2px red;"
                                               value="{{ old('alias') }}">
                                    @else
                                        <input type="text" class="form-control input_in_admin" name="alias"
                                               value="{{ isset($category->alias) ? $category->alias : old('alias') }}">
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>


                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-2">
                                <label class="control-label">Теги:(Через запятую)</label>
                            </div>
                            @if($errors->has('tags'))
                                <div class="col-lg-10">
                                    <input type="text" class="form-control input_in_admin" name="tags"
                                           style="border: solid 2px red;"
                                           value="{{ old('tags') }}" placeholder="Вводить через запятую">
                                </div>
                            @else
                                <div class="col-lg-10">
                                    <input type="text" class="form-control input_in_admin" name="tags"
                                           placeholder="Вводить через запятую"
                                           value="{{ isset($category->tags) ? implode(',', json_decode($category->tags)) : old('tags') }}">
                                </div>
                            @endif
                        </div>
                    </div>

                    <br>


                    <button class="change_lang" data-lang="en">EN</button>
                    <button class="change_lang" data-lang="ru">RU</button>
                    <button class="change_lang" data-lang="ua">UA</button>

                    <hr>

                    @php($language = ['en','ru','ua'])
                    @foreach($language as $key => $lang)

                        <div id="{{ $lang }}">


                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <label class="control-label">Имя на {{ strtoupper($lang) }} : </label>
                                    </div>
                                    @if($errors->has('name.'. $lang))
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control input_in_admin"
                                                   style="border: solid 2px red;"
                                                   name="name[{{ $lang }}]"
                                                   value="{{ old('name.'. $lang)}}">
                                        </div>
                                    @else
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control input_in_admin"
                                                   name="name[{{ $lang }}]"
                                                   value="{{ isset($category->all_data[$key]->name) ? $category->all_data[$key]->name : old('name.'. $lang)}}">
                                        </div>
                                    @endif
                                </div>
                            </div>


                            {{--                            <div class="form-group">--}}
                            {{--                                <label class="col-lg-5 control-label">{{ strtoupper($lang) }} Meta title</label>--}}
                            {{--                                @if($errors->has('meta_title.' . $lang))--}}
                            {{--                                    <div class="col-lg-12" style="border: solid 2px red;">--}}
                            {{--                                        <input type="text" class="form-control input_in_admin"--}}
                            {{--                                               name="meta_title[{{ $lang }}]"--}}
                            {{--                                               value="{{ old('meta_title.'. $lang)}}">--}}
                            {{--                                    </div>--}}
                            {{--                                @else--}}
                            {{--                                    <div class="col-lg-12">--}}
                            {{--                                        <input type="text" class="form-control input_in_admin"--}}
                            {{--                                               name="meta_title[{{ $lang }}]"--}}
                            {{--                                               value="{{ isset($lesson->all_data[$key]->meta_title) ? $lesson->all_data[$key]->meta_title : old('meta_title.'. $lang)}}">--}}
                            {{--                                    </div>--}}
                            {{--                                @endif--}}
                            {{--                            </div>--}}


                            {{--                            <div class="form-group">--}}
                            {{--                                <label class="col-lg-5 control-label">{{ strtoupper($lang) }} Meta description</label>--}}
                            {{--                                @if($errors->has('meta_description.'. $lang))--}}
                            {{--                                    <div class="col-lg-12" style="border: solid 2px red;">--}}
                            {{--                                        <input type="text" class="form-control input_in_admin"--}}
                            {{--                                               name="meta_description[{{ $lang }}]"--}}
                            {{--                                               value="{{ old('meta_description.'. $lang)}}">--}}
                            {{--                                    </div>--}}
                            {{--                                @else--}}
                            {{--                                    <div class="col-lg-12">--}}
                            {{--                                        <input type="text" class="form-control input_in_admin"--}}
                            {{--                                               name="meta_description[{{ $lang }}]"--}}
                            {{--                                               value="{{ isset($lesson->all_data[$key]->meta_description) ? $lesson->all_data[$key]->meta_description : old('meta_description.'. $lang)}}">--}}
                            {{--                                    </div>--}}
                            {{--                                @endif--}}
                            {{--                            </div>--}}


                            {{--                            <div class="form-group">--}}
                            {{--                                <label class="col-lg-5 control-label">{{ strtoupper($lang) }} Meta keywords</label>--}}
                            {{--                                @if($errors->has('meta_keywords.'. $lang))--}}
                            {{--                                    <div class="col-lg-12" style="border: solid 2px red;">--}}
                            {{--                                        <input type="text" class="form-control input_in_admin"--}}
                            {{--                                               name="meta_keywords[{{ $lang }}]"--}}
                            {{--                                               value="{{ old('meta_keywords.'. $lang)}}">--}}
                            {{--                                    </div>--}}
                            {{--                                @else--}}
                            {{--                                    <div class="col-lg-12">--}}
                            {{--                                        <input type="text" class="form-control input_in_admin"--}}
                            {{--                                               name="meta_keywords[{{ $lang }}]"--}}
                            {{--                                               value="{{ isset($lesson->all_data[$key]->meta_keywords) ? $lesson->all_data[$key]->meta_keywords : old('meta_keywords.'. $lang)}}">--}}
                            {{--                                    </div>--}}
                            {{--                                @endif--}}
                            {{--                            </div>--}}


                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <label class="control-label">Описание на {{ strtoupper($lang) }}
                                            :</label>
                                    </div>
                                    @if($errors->has('description.'. $lang))
                                        <div class="col-lg-10">
                                        <textarea rows="5" class="form-control input_in_admin"
                                                  style="border: solid 2px red;"
                                                  name="description[{{ $lang }}]">{{ old('description.'. $lang)}}</textarea>
                                        </div>
                                    @else
                                        <div class="col-lg-10">
                                        <textarea rows="5" class="form-control input_in_admin"
                                                  name="description[{{ $lang }}]">{{ isset($category->all_data[$key]->description) ? $category->all_data[$key]->description : old('description.'. $lang)}}</textarea>
                                        </div>
                                    @endif
                                </div>
                            </div>

                        </div>

                    @endforeach

                </form>

                <br>

                @include('admin.add_store_or_back_button')

            </div>

        </div>

    </div>

    @include('admin.change_lang')

    <script src="{{ asset('js/script_en.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/script_ru.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/script_ua.js') }}" type="text/javascript"></script>

@endsection

