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
                <input type="text" class="form-control" name="nama_lengkap" placeholder="Nama lengkap" value="{{$table->nama}}" required>
            </div>
            <div class="mb-3">
                <label class="form-label"><b>Alamat</b></label>
                <input type="text" class="form-control" name="alamat" placeholder="Alamat" value="{{$table->alamat}}" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label"><b>Tanggal lahir (YYYY-MM-DD)</b></label>
                <input type="text" class="form-control" name="tanggal_lahir" placeholder="Tanggal lahir" value="{{$table->tanggal_lahir}}" required>
            </div>
            <div class="mb-3">
                <label class="form-label"><b>Jabatan</b></label>
                <input type="text" class="form-control" name="jabatan" placeholder="Jabatan" value="{{$table->jabatan}}" required>
            </div>

            <div class="mb-3">
                <label class="form-label"><b>Penghasilan</b></label>
                <input type="number" class="form-control" name="penghasilan" placeholder="Penghasilan" value="{{$table->penghasilan}}" required>
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Update</button>
        </form>
        </div>
    </div>
</div>
@endsection
