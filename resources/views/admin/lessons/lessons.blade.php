@extends('site.layouts.layout')

@section('content')

    <div class="container-fluid">

        <div class="row">

            @include('admin.left_aside_menu')

            <div class="col-lg-10">

                <h3>Уроки</h3>

                @include('admin.add_button')

                <table class="table table-dark">

                    <thead>

                    <tr>

                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Short description</th>
                        <th scope="col">Category</th>
                        <th scope="col">Created date</th>
                        <th scope="col">Updated date</th>
                        <th scope="col">Action</th>

                    </tr>

                    </thead>

                    <tbody>

                    @foreach($lessons as $lesson)

                        <tr>

                            <th scope="row">{{ $lesson->id }}</th>
                            <td>{{ $lesson->all_data[0]->name }}</td>
                            <td>{{ $lesson->all_data[0]->short_description }}</td>
                            <td>
                                @foreach($categories as $category)
                                    @if($category->id == $lesson->category_id)
                                        {{ $category->data->name }}
                                    @endif
                                @endforeach
                            </td>

                            <td>{{ $lesson->created_at }}</td>
                            <td>{{ $lesson->updated_at }}</td>
                            <td>
                                <a href="{{ url('admin/lessons/' . $lesson->id . '/edit' ) }}">
                                    <button title="Редактировать" class="badge badge-pill badge-primary"><span
                                            class="oi oi-pencil"></span></button>
                                </a>

                                @if($lesson->enabled)

                                    <button title="Отключить" class="badge badge-pill badge-primary enable-button"
                                            data-id="{{ $lesson->id }}" data-enabled="enabled"
                                            data-token="{{ csrf_token() }}">
                                        <span class="oi oi-power-standby"></span></button>
                                @else

                                    <button title="Включить" class="badge badge-pill badge-secondary enable-button"
                                            data-id="{{ $lesson->id }}" data-enabled="not_enabled"
                                            data-token="{{ csrf_token() }}">
                                        <span class="oi oi-power-standby"></span></button>
                                @endif

                            </td>

                        </tr>

                    @endforeach

                    </tbody>

                </table>


            </div>

        </div>

        <div class="row justify-content-center">

            {{ $lessons->links('vendor.pagination.bootstrap-4') }}

        </div>

    </div>

    <script>
        $('.enable-button').on('click', function () {
            var lessonId = $(this).data('id');
            var element = $(this);

            $.ajax({
                method: 'post',
                url: '/lessons_enabled',
                dataType: 'json',
                data: {
                    _token: $(this).data('token'),
                    id: lessonId,
                },
                success: function () {
                    if(element.data('enabled') == 'enabled')
                    {
                        element.removeClass('badge-primary');
                        element.addClass('badge-secondary');
                        element.attr('data-enabled','not_enabled').data('enabled','not_enabled');
                        console.log('Disabled');
                        return;
                    }
                    if(element.data('enabled') == 'not_enabled')
                    {
                        element.removeClass('badge-secondary');
                        element.addClass('badge-primary');
                        element.attr('data-enabled','enabled').data('enabled','enabled');
                        console.log('Enabled');
                        return;
                    }
                },
                error: function (errorThrown) {
                    console.log(errorThrown);
                }
            });

        });

    </script>

@endsection
