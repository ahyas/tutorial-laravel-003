@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">Pengajuan perubahan data kependudukan</div>

        <div class="card-body">
        <p>Pastikan seluruh data sudah lengkap untuk mengajukan perubahan data status perkawinan</p>
        <form action="{{route('perkara.pengajuan.update', ['id_perkara'=>$akta_cerai->perkara_id,'id_pihak'=>$pihak->pihak_id])}}" method="POST">
        {{ csrf_field() }}
            <div class="mb-3">
                <label class="form-label"><b>Nama</b></label>
                <input type="text" class="form-control" placeholder="Nama lengkap" name="nama" value="{{$pihak->nama}}">
            </div>
            <div class="mb-3">
                <label class="form-label"><b>Alamat</b></label>
                <input type="text" class="form-control" name="alamat" placeholder="Alamat" value="{{$pihak->alamat}}">
            </div>
            <div class="mb-3">
                <label class="form-label"><b>NIK</b></label>
                <input type="text" class="form-control" name="nik" placeholder="Nomor Induk Kependudukan" value="{{$pihak->nomor_indentitas}}">
            </div>
            <div class="mb-3">
                <label class="form-label"><b>Jenis Kelamin</b></label>
                <select class="form-control">
                    <option value="L" <?php if($pihak->jenis_kelamin=='L'){echo 'selected'; }else{echo'';}?>>Laki-laki</option>
                    <option value="P" <?php if($pihak->jenis_kelamin=='P'){echo 'selected'; }else{echo'';}?>>Perempuan</option>
                </select>
            </div>
            <a class="btn btn-danger btn-sm" href="{{URL::previous()}}">Batal</a> <button type="submit" class="btn btn-primary btn-sm">Update</button>
        </form>
        </div>
    </div>
</div>
@endsection
