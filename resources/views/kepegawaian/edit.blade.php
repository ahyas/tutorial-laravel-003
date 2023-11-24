@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Edit data pegawai</div>

        <div class="card-body">
        <form action="update" method="POST">
            {{ csrf_field() }} {{ method_field('PUT') }} 
            <div class="mb-3">
                <label class="form-label"><b>Nama lengkap</b></label>
                <input type="text" class="form-control" name="nama_lengkap" placeholder="Nama lengkap" value="{{old('nama_lengkap', $table->nama)}}">
                @if ($errors->has('nama_lengkap'))
                    <span class="text-danger">{{ $errors->first('nama_lengkap') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label class="form-label"><b>Alamat</b></label>
                <input type="text" class="form-control" name="alamat" placeholder="Alamat" value="{{old('alamat', $table->alamat)}}">
                @if ($errors->has('alamat'))
                    <span class="text-danger">{{ $errors->first('alamat') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label class="form-label"><b>Email</b></label>
                <input type="text" class="form-control" name="email" placeholder="Email" value="{{old('email',$table->email)}}">
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label class="form-label"><b>Tanggal lahir (YYYY-MM-DD)</b></label>
                <input type="text" class="form-control" name="tanggal_lahir" placeholder="Tanggal lahir" value="{{old('tanggal_lahir', $table->tanggal_lahir)}}">
                @if ($errors->has('tanggal_lahir'))
                    <span class="text-danger">{{ $errors->first('tanggal_lahir') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label class="form-label"><b>Jabatan</b></label>
                <input type="text" class="form-control" name="jabatan" placeholder="Jabatan" value="{{old('jabatan', $table->jabatan)}}">
                @if ($errors->has('jabatan'))
                    <span class="text-danger">{{ $errors->first('jabatan') }}</span>
                @endif
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Update</button>
        </form>
        </div>
    </div>
</div>
@endsection
