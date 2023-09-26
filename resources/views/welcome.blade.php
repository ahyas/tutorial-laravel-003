
@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">Selamat datang</div>

        <div class="card-body">
            @if(session()->has('errors'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('errors') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @else
                <p>Selamat datang</p>
            @endif
        </div>
    </div>
</div>

@endsection
