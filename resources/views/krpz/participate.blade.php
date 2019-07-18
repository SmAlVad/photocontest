@extends('layouts.krpz')

@section('content')
    <div class="container">

        @if($errors->any())
            <div class="row justify-content-center">
                <div class="col-md-11">
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="close">
                            <span aria-hidden="true">x</span>
                        </button>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>
                                    {{ $error }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-xl-8">
                <form action="{{ route('krpz-add') }}" method="POST" enctype="multipart/form-data">

                    @csrf

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label col-form-label-lg">Ваше&nbsp;<span
                                class="red-star">*</span></label>
                        <div class="col-sm-10">
                            <input type="text"
                                   class="form-control form-control-lg"
                                   id="name"
                                   aria-describedby="emailHelp"
                                   name="name"
                                   value="{{ old('name') }}"
                                   placeholder="имя"
                                   required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tel" class="col-sm-2 col-form-label col-form-label-lg">Телефон&nbsp;<span
                                class="red-star">*</span></label>
                        <div class="col-sm-10">
                            <input type="text"
                                   class="form-control form-control-lg"
                                   id="tel"
                                   name="phone"
                                   value="{{ old('phone') }}"
                                   placeholder="+7-999-99-99"
                                   required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label col-form-label-lg">Почта</label>
                        <div class="col-sm-10">
                            <input type="email"
                                   class="form-control form-control-lg"
                                   id="email"
                                   name="email"
                                   placeholder="mail@mail.ru">
                        </div>
                    </div>

                    <div class="form-group" id="krpz-file-input">
                        <div class="preview"></div>

                        <div class="file-upload-label-wrapper">
                            <label for="files" id="file-upload-label">Выберите фото</label>
                            <div class="file-rules">До 3 фото, JPG,PNG, < 5 Мб.</div>
                        </div>

                        <input type="file"
                               class="form-control-file"
                               id="files" name="attachment[]"
                               accept=".png, .jpg, .jpeg"
                               multiple
                               required>

                    </div>

                    <button type="submit" class="krpz-submit-btn">Отправить</button>
                </form>
            </div>
        </div>
    </div>
@endsection
