@extends('krpz.layouts.krpz')

@section('content')

    <section class="banner-another"></section>

    <div id="about-us">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-12">
                    <h3>Вы успешно добавили фото!</h3>

                    <p>
                        Написать текст чтобы люди не путались
                    </p>

                    <a data-aos="fade-left" data-aos-delay="500" class="btn btn-success"
                       href="{{ route('krpz-all') }}" role="button">Все работы</a>

                </div>

                <div class="col-md-12 col-12 button">
                    <a class="btn btn-success" href="{{ route('krpz-all') }}" role="button">Все работы</a>
                </div>

            </div>
        </div>
    </div>
@endsection
