@extends('layouts.krpz')

@section('content')

    @if(session('flash_message'))
        <div class="alert alert-info flash">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <span>{{ session('flash_message') }}</span>
        </div>
    @endif

    <div class="container">

        <div class="krpz-top-banner">
            <div class="krpz-top-banner-title-wrapper">
                <div class="krpz-top-banner-title">
                    <h1>Блондинки vs Брюнетки</h1>
                    <p>
                        Свершилось! Наконец-то мы сможем поставить точку в вечном споре, кто же круче - блондинки или
                        брюнетки.
                    </p>
                </div>
            </div>
        </div>


        <div class="krpz-add">
            @if($photocontest->end > now())
                <a href="{{ route('krpz-participate') }}" class="krpz-add-btn">Принять участие</a>
            @else
                <h5>Голосование за участников завершилось:&nbsp;{{ $photocontest->end }}</h5>
            @endif
        </div>

        <div class="row justify-content-center">
            <div class="col-xl-12">
                <div class="sort-btn-wrapper">
                    <div class="sort-btn">
                        <a href="#" class="sort-btn-active">По популярности</a>
                        <a href="#">По дате добавления</a>
                    </div>
                </div>

            </div>
            @foreach($images as $image)
                <div class="col-xl-4">
                    <div class="krpz-image">
                        <img src="/storage/{{ $image->file_name }}.{{ $image->ext }}" alt="">
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
