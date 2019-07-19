@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Проекты</div>

                    <div class="list-group">
                        <a href="{{ route('krpz') }}" class="list-group-item list-group-item-action">Карапузы</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
