@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">Manajemen user</div>

        <div class="card-body">
            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <a class="btn btn-primary btn-sm" href="{{route('register')}}">Tambah</a>
            
            <table class="table table-striped table-sm" style="margin-bottom:10px; margin-top:10px">
                <tr>
                    <th>Nama</th>
                    <th>Role</th>
                    <th>Email</th>
                    <th>No. Telp</th>
                    <th>Status</th>
                    <th></th>
                </tr>
                @foreach($table as $row)
                    <tr>
                        <td>{{$row->name}}</td>
                        <td>{{$row->role}}</td>
                        <td>{{$row->email}}</td>
                        <td>{{$row->no_telp}}</td>
                        <td>
                            @if($row->id_status == 1)
                                <span class="badge rounded-pill bg-success text-white">{{$row->status}}</span>
                            @else
                                <span class="badge rounded-pill bg-danger text-white">{{$row->status}}</span>
                            @endif
                        </td>
                        <td><a class="btn btn-primary btn-sm" href="users/{{$row->id_user}}/detail">Detail</a></td>
                    </tr>
                @endforeach
            </table>
            
        </div>
    </div>
</div>
@endsection
