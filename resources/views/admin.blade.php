@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            @foreach($contests as $contest)
                <div class="col-md-6">
                    <a href="{{ route('admin-index') }}/{{ $contest->name }}">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">{{ $contest->name }}</h5>
                                <p class="card-text">
                                    <small class="text-muted">Дата окончания:&nbsp;{{ $contest->end }}</small>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
