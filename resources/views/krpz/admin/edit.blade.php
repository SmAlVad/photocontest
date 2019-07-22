@extends('layouts.admin')

@section('content')
    <div class="container">

        @include('krpz.admin.errors')
        
        <h2>Редактирование фотографии</h2>

        <img src="/storage/{{ $image->file_name }}" alt="" width="100%" class="mb-2">

        <form action="{{ route('admin-krpz-update', $image->id) }}" id="admin-edit-form">

            <div class="form-group">
                <label for="description">Описание</label>
                <input type="text" class="form-control" id="description" name="description" value="{{ $image->description }}">
            </div>

            <div class="form-group">
                <label for="like">Голоса</label>
                <input type="text" class="form-control" id="like" name="like" value="{{ $image->like }}">
            </div>

            <div class="form-group form-check">
                <input type="checkbox"
                       class="form-check-input"
                       name="is_active"
                       value="{{ $image->is_active }}"
                       id="form-checkbox"
                       @if($image->is_active) checked @endif>
                <label class="form-check-label" for="is_active">Активено</label>

                <input type="hidden" name="is_active" value="{{ $image->is_active }}" id="is_active">

            </div>

            <button type="submit" class="btn btn-primary">Изменить</button>

        </form>
    </div>

@endsection
