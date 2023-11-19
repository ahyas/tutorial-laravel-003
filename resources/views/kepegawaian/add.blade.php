@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Tambah data pegawai</div>

        <div class="card-body">
        <form action="save" method="POST">
            {{ csrf_field() }}            
            <div class="mb-3">
                <label class="form-label"><b>Nama lengkap</b></label>
                <input type="text" class="form-control" name="nama_lengkap" placeholder="Nama lengkap" required>
            </div>
            <div class="mb-3">
                <label class="form-label"><b>Alamat</b></label>
                <input type="text" class="form-control" name="alamat" placeholder="Alamat" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label"><b>Tanggal lahir (YYYY-MM-DD)</b></label>
                <input type="text" class="form-control" name="tanggal_lahir" placeholder="Tanggal lahir" required>
            </div>
            <div class="mb-3">
                <label class="form-label"><b>Jabatan</b></label>
                <input type="text" class="form-control" name="jabatan" placeholder="Jabatan" required>
            </div>

            <div class="mb-3">
                <label class="form-label"><b>Penghasilan</b></label>
                <input type="number" class="form-control" name="penghasilan" placeholder="Penghasilan" required>
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
        </form>
        </div>
    </div>
</div>
@endsection
