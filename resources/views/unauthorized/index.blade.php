@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">Page Error</div>

        <div class="card-body">
            
            <div class="alert alert-danger" role="alert">
                Anda tidak memiliki hak akses untuk  halaman ini
            </div>
            <a class="btn btn-primary btn-sm" href="{{route('home')}}">Mengerti</a>
        </div>
    </div>
</div>
@endsection
