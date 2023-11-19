@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Daftar pegawai </div>

        <div class="card-body">
            <a class="btn btn-primary btn-sm" href="add" style="margin-bottom:15px">Tambah</a>
            <form action="find" method="GET">
            <span>Pencarian pegawai</span>
                <div class="form-row">
                    <div class="col-10  ">
                        <input type="text" class="form-control form-control-sm" placeholder="Masukan nama pegawai" name="kata_kunci" style="margin-bottom:15px" >
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary btn-sm btn-block">Cari</button>
                    </div>
                    <div class="col">
                        <a href="index" class="btn btn-danger btn-sm btn-block">Reset</a>
                    </div>
                </div>
            </form>

            <table class="table table-striped">
                <tr>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Tanggal lahir</th>
                    <th>Jabatan</th>
                    <th>Penghasilan</th>
                    <th>Action</th>
                </tr>
                @foreach($table as $row)
                <tr>
                    <td>{{$row->nama}}</td>
                    <td>{{$row->alamat}}</td>
                    <td>{{$row->tanggal_lahir}}</td>
                    <td>{{$row->jabatan}}</td>
                    <td>{{$row->penghasilan}}</td>
                    <td><a class="btn btn-success btn-sm" href="{{$row->id}}/edit">Edit</a> <a class="btn btn-danger btn-sm" href="{{$row->id}}/delete">Delete</a></td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection
