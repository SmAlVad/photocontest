@extends('layouts.admin')

@section('content')
    @include('krpz.admin.success')

    <div class="container">

        @include('krpz.admin.errors')

        <div class="row">

            <div class="col-xl-6 mb-4">
                <ul class="list-group list-group-horizontal-sm">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Всего&nbsp;&nbsp;
                        <span class="badge badge-primary badge-pill">{{ $count['all'] }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Активных&nbsp;&nbsp;
                        <span class="badge badge-primary badge-pill">{{ $count['active'] }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Не активных&nbsp;&nbsp;
                        <span class="badge badge-primary badge-pill">{{ $count['nonActive'] }}</span>
                    </li>
                </ul>
            </div>

            <div class="col-xl-6">
                <form action="{{ route('admin-krpz-search') }}" method="GET" class="mb-4">
                    <div class="row">
                        <div class="col-xl-2">
                            <label for="sort-active" class="">Показать</label>
                        </div>
                        <div class="col-xl-8">
                            <select id="sort-active" class="form-control form-control-sm" name="is_active">
                                <option value="all">Все</option>
                                <option value="yes">Все активные</option>
                                <option value="no">Все не активные</option>
                            </select>
                        </div>

                        <div class="col-xl-2"><button type="submit" class="btn btn-primary btn-sm">Вперёд</button></div>
                    </div>
                </form>
            </div>

            <div class="col-xl-12">
                <table class="table table-sm" style="width: 100%">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Фото</th>
                        <th scope="col">Пользователь</th>
                        <th scope="col">Телефон</th>
                        <th scope="col">Описание</th>
                        <th scope="col">Голоса</th>
                        <th scope="col">Активировать</th>
                        <th scope="col">Редактировать</th>
                        <th scope="col">Удалить</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($images as $image)
                        <tr class="@if($image->is_active) table-success @endif tr-image-{{ $image->id }}">
                            <th scope="row">{{ $image->id }}</th>
                            <td><img src="/storage/{{ $image->file_name }}" alt="" width="200px"></td>
                            <td class="text-center">{{ $image->participant->name }}</td>
                            <td>{{ $image->participant->phone }}</td>
                            <td>{{ $image->description }}</td>
                            <td class="text-center">{{ $image->like }}</td>
                            <td class="text-center">
                                @if($image->is_active)
                                    <div
                                        class="btn btn-outline-success control-image-btn"
                                        data-id="{{ $image->id  }}"
                                        data-url="{{ route('admin-krpz-control-image') }}"
                                    >
                                        <i class="fas fa-toggle-on"></i>
                                    </div>
                                @else
                                    <div
                                        class="btn btn-outline-secondary control-image-btn"
                                        data-id="{{ $image->id  }}"
                                        data-url="{{ route('admin-krpz-control-image') }}"
                                    >
                                        <i class="fas fa-toggle-off"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="text-center">
                                <a class="btn btn-primary" href="{{ route('admin-krpz-edit', $image->id) }}"><i class="fas fa-edit"></i></a>
                            </td>
                            <td class="text-center">
                                <form action="{{ route('admin-krpz-destroy', $image->id) }}">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-danger"
                                            onclick="confirm('Вы уверены?')"
                                    >
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
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



