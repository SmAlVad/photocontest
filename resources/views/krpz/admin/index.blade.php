@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <table class="table table-sm">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Фото</th>
                        <th scope="col">Пользователь</th>
                        <th scope="col">Телефон</th>
                        <th scope="col">Описание</th>
                        <th scope="col">Голоса</th>
                        <th scope="col">Активен?</th>
                        <th scope="col">Редактировать</th>
                        <th scope="col">Удалить</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($images as $image)
                        <tr class="@if($image->is_active) table-success @endif">
                            <th scope="row">{{ $image->id }}</th>
                            <td><img src="/storage/{{ $image->file_name }}" alt="" width="200px"></td>
                            <td>{{ $image->participant->name }}</td>
                            <td>{{ $image->participant->phone }}</td>
                            <td>{{ $image->description }}</td>
                            <td>{{ $image->like }}</td>
                            <td>{{ $image->is_active }}</td>
                            <td>Редактировать</td>
                            <td>Удалить</td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>

            <div class="col-xl-12">
                {{ $images->links() }}
            </div>
        </div>

    </div>


@endsection



