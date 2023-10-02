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
                <input type="text" class="form-control" placeholder="Nama lengkap" name="nama" value="{{$pihak->nama}}" autofocus>
            </div>
            <div class="mb-3">
                <label class="form-label"><b>Alamat</b></label>
                <input type="text" class="form-control" name="alamat" placeholder="Alamat" value="{{$pihak->alamat}}">
            </div>
            
            <div class="mb-3">
                <label class="form-label"><b>Provinsi</b></label>
                <select class="form-control" name="provinsi">
                    <option value="0">Pilih Provinsi</option>
                    @foreach($provinsi as $row)
                    <option value="{{$row->id_provinsi}}" <?php if($row->id_provinsi == $pihak->propinsi_id){echo"selected"; } ?>>{{$row->provinsi}}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label"><b>Kabupaten</b></label>
                <select class="form-control" name="kabupaten">
                    <option value="0">Pilih Kabupaten</option>
                    @foreach($kabupaten as $row)
                    <option value="{{$row->id_kabupaten}}" <?php if($row->id_kabupaten == $pihak->kabupaten_id){echo"selected"; } ?>>{{$row->kabupaten}}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="mb-3">
                <label class="form-label"><b>NIK</b></label>
                <input type="text" class="form-control" name="nik" placeholder="Nomor Induk Kependudukan" value="{{$pihak->nomor_indentitas}}">
            </div>
            <div class="mb-3">
                <label class="form-label"><b>Nomor Telp.</b></label>
                <input type="text" class="form-control" name="telepon" placeholder="Nomor Telpon" value="{{$pihak->telepon}}">
            </div>
            <div class="mb-3">
                <label class="form-label"><b>Jenis Kelamin</b></label>
                <select class="form-control" name="jenis_kelamin">
                    <option value="0">Pilih jenis kelamin</option>
                    <option value="L" <?php if($pihak->jenis_kelamin=='L'){echo 'selected'; }?>>Laki-laki</option>
                    <option value="P" <?php if($pihak->jenis_kelamin=='P'){echo 'selected'; }?>>Perempuan</option>
                </select>
            </div>
            <a class="btn btn-danger btn-sm" href="{{URL::previous()}}">Batal</a> <button type="submit" class="btn btn-primary btn-sm">Update</button>
        </form>
        </div>
    </div>
</div>
@endsection
