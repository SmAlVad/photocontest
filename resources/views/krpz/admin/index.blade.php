@extends('layouts.admin')

@section('content')
    @include('krpz.admin.success')

    <div class="container">

        @include('krpz.admin.errors')

        <div class="row">
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
{{--                                    <form action="{{ route('admin-krpz-deactivate-image') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $image->id  }}">
                                        <button type="submit" class="btn btn-outline-success">
                                            <i class="fas fa-toggle-on"></i>
                                        </button>
                                    </form>--}}
                                    <div
                                        class="btn btn-outline-success control-image-btn"
                                        data-id="{{ $image->id  }}"
                                        data-url="{{ route('admin-krpz-control-image') }}"
                                    >
                                        <i class="fas fa-toggle-on"></i>
                                    </div>
                                @else
 {{--                                   <form action="{{ route('admin-krpz-activate-image') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $image->id  }}">
                                        <button type="submit" class="btn btn-outline-secondary"><i
                                                class="fas fa-toggle-off"></i></button>
                                    </form>--}}
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



