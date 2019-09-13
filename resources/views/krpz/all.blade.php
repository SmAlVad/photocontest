@extends('krpz.layouts.krpz')

@section('content')

    <section class="banner-another"></section>

    <div class="container-fluid py-4">

        <div class="row">
            <div class="col-xl-12 mb-2">
                <div class="sort-buttons">
                    <a href="{{ route('krpz-all') }}"
                       class="btn btn-{{ $sortLinkActive == 'sort-by-date' ? 'success disabled' : 'light' }}">
                        По дате добавления
                    </a>

                    <a href="{{ route('krpz-all', ['sort' => 'like']) }}"
                       class="btn btn-{{ $sortLinkActive == 'sort-by-like' ? 'success disabled' : 'light' }}"
                    >
                        По популярности
                    </a>
                </div>

            </div>
        </div>

        <div class="row" data-aos="fade-up" data-aos-duration="400">

            @foreach($images as $image)
                <div class="col-md-6 col-lg-3">
                    <div class="krpz-img">

                        <div class="image-action">
                            <div class="zoom-img">
                                <i class="fa fa-search-plus" aria-hidden="true"></i>
                            </div>
                            @if(!$showResult)
                                <div class="like-image" data-id="{{ $image->id }}">
                                    <i class="far fa-heart" aria-hidden="true"></i>
                                </div>
                            @endif
                            <img src="/storage/{{ $image->file_name }}" alt="{{ $image->description }}">
                        </div>

                        <h4>
                            <span class="like-counter">
                                <i class="far fa-heart mr-1" aria-hidden="true"></i>{{ $image->like }}
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

        <div class="row" data-aos="fade-up" data-aos-duration="400">
            <div class="col-xl-12">
                {{ $images->links() }}
            </div>
        </div>
    </div>

    <section class="blog"></section>
@endsection
