@extends('krpz.layouts.krpz')

@section('content')
    <!-- Banner section Start -->
    <section class="banner-home">
        <!-- Gradient -->
        <div class="gradient"></div>
        <!-- container Start-->
        <div class="container">
            <!--Row Start-->
            <div class="row">
                <div class="col-sm-12">
                    <h1 data-aos="fade-left">Блондинки vs Брюнетки</h1>
                    <h2 data-aos="fade-left" data-aos-delay="100">
                        Свершилось! Наконец-то мы сможем поставить точку в вечном споре, кто же круче - блондинки или
                        брюнетки.
                    </h2>

                    <a data-aos="fade-left" data-aos-delay="500" class="btn btn-success"
                       href="{{ route('krpz-participate') }}" role="button">Принять участие</a>
                </div>
            </div>
            <!--Row Ended-->
        </div>
        <!-- container Ended-->
    </section>
    <!-- Banner section Ended -->

    <!-- Blog section start-->
    <section class="blog">
        <!-- container Start-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-12 heading">
                    <img src="images/leaf.png" alt="">
                    <h2>Голосуй за участников!</h2>
                    <h3>Давай давай!</h3>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 mb-2">
                    <div class="sort-buttons">
                        <a href="{{ route('krpz') }}"
                           class="btn btn-{{ $sortLinkActive == 'sort-by-like' ? 'success disabled' : 'light' }}"
                        >
                            По популярности
                        </a>

                        <a href="{{ route('krpz', ['sort' => 'created_at']) }}"
                           class="btn btn-{{ $sortLinkActive == 'sort-by-date' ? 'success disabled' : 'light' }}">
                            По дате добавления
                        </a>
                    </div>

                </div>
            </div>

            <div class="row" data-aos="fade-up" data-aos-duration="400">

                @foreach($images as $image)
                    <div class="col-md-3">
                        <div class="krpz-img">

                            <div class="image-action">
                                <div class="zoom-img">
                                    <i class="fa fa-search-plus" aria-hidden="true"></i>
                                </div>
                                <div class="like-image" data-id="{{ $image->id }}">
                                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                                </div>
                                <img src="/storage/{{ $image->file_name }}" alt="{{ $image->description }}">
                            </div>

                            <h4>
                                <span class="like-counter">
                                    <i class="fa fa-heart" aria-hidden="true"></i><span id="like-counter-{{ $image->id }}">{{ $image->like }}</span>
                                </span>
                                {{ $image->description }}
                            </h4>
                            <div class="image-info">
                                <span>{{ $image->created_at }}</span>
                                Разместил(а) <b>{{ $image->participant->name }}</b>
                            </div>

                        </div>
                    </div>
                @endforeach

            </div>

            <div class="row">
                <div class="col-md-12 col-12 button">
                    <a class="btn btn-success" href="{{ route('krpz-all') }}" role="button">Все работы</a>
                </div>
            </div>

        </div>
        <!-- container Ended-->
    </section>
    <!-- Blog section Ended-->
@endsection
