@extends('site.layouts.layout')

@section('content')

    <div class="container-fluid">

        <div class="row">

            @include('admin.left_aside_menu')

            <div class="col-lg-10">

                <h3>Категории</h3>

                @include('admin.add_button')

                <table class="table table-dark">

                    <thead>

                    <tr>

                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Created date</th>
                        <th scope="col">Updated date</th>
                        <th scope="col">Action</th>

                    </tr>

                    </thead>

                    <tbody>

                    @foreach($categories as $category)

                        <tr>

                            <th scope="row">{{ $category->id }}</th>
                            <td>{{ $category->all_data[0]->name }}</td>
                            <td>{{ $category->all_data[0]->description }}</td>
                            <td>{{ $category->created_at }}</td>
                            <td>{{ $category->updated_at }}</td>
                            <td>
                                <a href="{{ url('admin/category/' . $category->id . '/edit' ) }}">
                                    <button title="Редактировать" class="badge badge-pill badge-primary"><span
                                            class="oi oi-pencil"></span></button>
                                </a>

                                @if($category->enabled)

                                    <button title="Отключить" class="badge badge-pill badge-primary" id="enable-button">
                                        <span class="oi oi-power-standby"></span></button>
                                @else

                                    <button title="Включить" class="badge badge-pill badge-secondary"
                                            id="enable-button"><span class="oi oi-power-standby"></span></button>
                                @endif

                            </td>

                        </tr>

                    @endforeach

                    </tbody>

                </table>


            </div>

        </div>

        <div class="row justify-content-center">

            {{ $categories->links('vendor.pagination.bootstrap-4') }}

        </div>

    </div>

@endsection

