@extends('krpz.layouts.krpz')

@section('content')

    <section class="banner-another"></section>

    <div id="about-us">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-12">
                    <h3>Вы успешно добавили фото!</h3>

                    <p>
                        Поздравляем, вы успешно добавили фотографию. Она появится на сайте сразу после модерации. Это займет совсем немного времени…
                    </p>

                    <a data-aos="fade-left" data-aos-delay="500" class="btn btn-success"
                       href="{{ route('krpz-all') }}" role="button">Все работы</a>

                </div>
            </div>
        </div>
    </div>
@endsection
