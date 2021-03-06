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
                <div class="col-lg-12 col-xl-8">
                    <div class="top-content">
                        <h1 data-aos="fade-left">Карапузы, на старт!</h1>
                        <h2 data-aos="fade-left" data-aos-delay="100">
                            @if(!$showResult)
                                Фотоконкурс для самых маленьких и активных малышей!
                            @else
                                Фотоконкурс для самых маленьких и активных малышей завершен!
                            @endif
                        </h2>
                        @if(!$showResult)
                            <h4 data-aos="fade-left" data-aos-delay="100">
                                Присылайте фотографии своих любимых карапузов на прогулке или во время игр дома.
                                Покажите, как детки помогают маме или задорно веселятся.
                            </h4>
                            <h4 data-aos="fade-left" data-aos-delay="200">
                                Мы ждем фотографий ваших карапузов, которые занимаются любимым делом! Не упустите шанс
                                выиграть призы!
                            </h4>
                            <h4 data-aos="fade-left" data-aos-delay="300" class="mt-3">
                                Кстати, если вы участвовали в веселом соревновании для малышей «Карапузы, на старт»,
                                то ваши снимки мы ждем с двойным удовольствием!
                            </h4>
                        @else
                            <h4 data-aos="fade-left" data-aos-delay="300" class="mt-3">
                                Спасибо всем за участие.
                            </h4>
                        @endif


                    </div>

                    <div class="top-content-mob">
                        <h1 data-aos="fade-left">Карапузы, на старт!</h1>
                        @if(!$showResult)
                            <h2 data-aos="fade-left" data-aos-delay="100">
                                Фотоконкурс для самых маленьких и активных малышей!
                            </h2>
                            <h6 data-aos="fade-left" data-aos-delay="100">
                                Присылайте фотографии своих любимых карапузов на прогулке или во время игр дома.
                                Покажите, как детки помогают маме или задорно веселятся.
                            </h6>
                            <h6 data-aos="fade-left" data-aos-delay="100">
                                Мы ждем фотографий ваших карапузов, которые занимаются любимым делом! Не упустите шанс
                                выиграть призы!
                            </h6>
                        @else
                            <h2 data-aos="fade-left" data-aos-delay="100">
                                Фотоконкурс для самых маленьких и активных малышей завершен!
                            </h2>
                            <h6 data-aos="fade-left" data-aos-delay="100">
                                Спасибо всем за участие.
                            </h6>
                        @endif
                    </div>
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
                    @if(!$showResult)
                        <h2>Голосуй за участников!</h2>
                        <div class="heading-desc">
                            <p>
                                Для того, чтобы оставить голос за понравившеюся работу, не нужно регистрироваться.
                            </p>
                            <p>
                                Один пользователь может проголосовать один раз за сутки.
                            </p>
                            <p>
                                Все попытки накрутки голосов будут аннулированы модераторами.
                            </p>
                        </div>
                    @else
                        <h2>Поздравляем победителя!</h2>
                    @endif
                </div>
            </div>

            @if(!$showResult)
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
            @endif

            <div class="row" data-aos="fade-up" data-aos-duration="400">

                @if($showResult)
                    <div class="col-lg-12">
                        <div class="winner">

                            <div class="winner-image">
                                <img src="/storage/{{ $winner->file_name }}" alt="{{ $winner->description }}">
                            </div>

                            <h4>
                            <span class="winner-like-counter">
                                <i class="far fa-heart" aria-hidden="true"></i><span
                                    id="like-counter-{{ $winner->id }}" class="ml-1">{{ $winner->like }}</span>
                            </span>
                                {{ $winner->description }}
                            </h4>
                            <div class="winner-image-info">
                                <span>{{ $winner->created_at }}</span>
                                Разместил(а) <b>{{ $winner->participant->name }}</b>
                            </div>

                        </div>
                    </div>
                @else
                    @foreach($images as $image)
                        <div class="col-md-6 col-lg-3">
                            <div class="krpz-img">

                                <div class="image-action">
                                    <div class="zoom-img">
                                        <i class="fas fa-search-plus" aria-hidden="true"></i>
                                    </div>
                                    <div class="like-image" data-id="{{ $image->id }}">
                                        <i class="far fa-heart" aria-hidden="true"></i>
                                    </div>
                                    <img src="/storage/{{ $image->file_name }}" alt="{{ $image->description }}">
                                </div>

                                <h4>
                                <span class="like-counter">
                                    <i class="far fa-heart" aria-hidden="true"></i><span
                                        id="like-counter-{{ $image->id }}" class="ml-1">{{ $image->like }}</span>
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
                @endif

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
