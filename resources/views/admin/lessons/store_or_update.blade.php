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
                      action="{{ $action == 'store' ? url('admin/' . $page) : url('admin/' . $page . '/id=' . $lesson->id )}}"
                      id="form">

                    {{ csrf_field() }}


                    @if($action == 'update')

                        <input type="hidden" name="lesson_id" value=" {{ $lesson->id }}">
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
                                               value="{{ isset($lesson->alias) ? $lesson->alias : old('alias') }}">
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>


                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-1">
                                <label class="control-label">Категория:</label>
                            </div>
                            @if($errors->has('category_id'))
                                <div class="col-lg-5">
                                    <select class="form-control select_input_in_admin" name="category_id">
                                        @foreach($categories as $category)
                                            @if($category->id == old('category_id'))
                                                <option value="{{ $category->id }}"
                                                        selected
                                                        class="select_input_in_admin">{{ $category->data->name }}</option>
                                            @else
                                                <option value="{{ $category->id }}"
                                                        class="select_input_in_admin">{{ $category->data->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            @else
                                <div class="col-lg-5">
                                    <select class="form-control select_input_in_admin" name="category_id">
                                        @foreach($categories as $category)
                                            @if(isset($lesson) && $category->id == $lesson->category_id)
                                                <option value="{{ $category->id }}"
                                                        selected
                                                        class="select_input_in_admin">{{ $category->data->name }}</option>
                                            @else
                                                <option value="{{ $category->id }}"
                                                        class="select_input_in_admin">{{ $category->data->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                        </div>
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
                                           value="{{ isset($lesson->tags) ? implode(',', json_decode($lesson->tags)) : old('tags') }}">
                                </div>
                            @endif
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-lg-6">
                            <label class="col-lg-5 control-label">Большая картинка</label>

                            <div style="border:solid 2px white;">
                                <div class="form-group">
                                    @if(isset($lesson->image_big) && file_exists('storage/image_big/' . $lesson->image_big))
                                        <img class="admin_image_big"
                                             src="{{ asset('storage/image_big/' . $lesson->image_big) }}">
                                    @else
                                        <img class="admin_image_big"
                                             src="{{ asset('/img/ava/icons8-electronic-music-100-1.png') }}">
                                    @endif
                                    <div class="col-lg-12">
                                        <input type="hidden"
                                               value="{{ isset($lesson->image_big) ? $lesson->image_big : '' }}"
                                               name="old_image_big">
                                        <input type="file" class="form-control input_in_admin" name="imageBig">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div style="border:solid 2px white;">
                                <label class="col-lg-5 control-label">Маленькая картинка</label>
                                <div class="form-group">
                                    @if(isset($lesson->image_small) && file_exists('storage/image_small/' . $lesson->image_small))
                                        <img class="admin_image_big"
                                             src="{{ asset('storage/image_small/' . $lesson->image_small) }}">
                                    @else
                                        <img class="admin_image_big"
                                             src="{{ asset('/img/ava/icons8-electronic-music-100-1.png') }}">
                                    @endif
                                    <div class="col-lg-12">
                                        <input type="hidden"
                                               value="{{ isset($lesson->image_small) ? $lesson->image_small : '' }}"
                                               name="old_image_small">
                                        <input type="file" class="form-control input_in_admin" name="imageSmall">
                                    </div>
                                </div>
                            </div>
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
                                                   value="{{ isset($lesson->all_data[$key]->name) ? $lesson->all_data[$key]->name : old('name.'. $lang)}}">
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
                                        <label class="control-label">Короткое описание на {{ strtoupper($lang) }}
                                            :</label>
                                    </div>
                                    @if($errors->has('short_description.'. $lang))
                                        <div class="col-lg-10">
                                        <textarea rows="2" class="form-control input_in_admin"
                                                  style="border: solid 2px red;"
                                                  name="short_description[{{ $lang }}]">{{ old('short_description.'. $lang)}}</textarea>
                                        </div>
                                    @else
                                        <div class="col-lg-10">
                                        <textarea rows="2" class="form-control input_in_admin"
                                                  name="short_description[{{ $lang }}]">{{ isset($lesson->all_data[$key]->short_description) ? $lesson->all_data[$key]->short_description : old('short_description.'. $lang)}}</textarea>
                                        </div>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <label class="control-label">Полное описание на {{ strtoupper($lang) }}
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
                                                  name="description[{{ $lang }}]">{{ isset($lesson->all_data[$key]->description) ? $lesson->all_data[$key]->description : old('description.'. $lang)}}</textarea>
                                        </div>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <label class="control-label">Текст на {{ strtoupper($lang) }} :</label>
                                    </div>
                                    @if($errors->has('text.'. $lang))
                                        <div class="col-lg-10">
                                        <textarea rows="10" class="form-control input_in_admin"
                                                  style="border: solid 2px red;"
                                                  name="text[{{ $lang }}]">{{ old('text.'. $lang)}}</textarea>
                                        </div>
                                    @else
                                        <div class="col-lg-10">
                                        <textarea rows="10" class="form-control input_in_admin"
                                                  name="text[{{ $lang }}]">{{ isset($lesson->all_data[$key]->text) ? $lesson->all_data[$key]->text : old('text.'. $lang)}}</textarea>
                                        </div>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <label class="control-label">Ссылка на видео {{ strtoupper($lang) }} : </label>
                                    </div>
                                    @if(isset($lesson->all_data[$key]->video))
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control input_in_admin"
                                                   name="video[{{ $lang }}]"
                                                   value="{{ $lesson->all_data[$key]->video }}">
                                        </div>
                                    @else
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control input_in_admin"
                                                   name="video[{{ $lang }}]">
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
