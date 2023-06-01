@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">Pengajuan perubahan data kependudukan</div>

        <div class="card-body">
            <h4 style="font-weight:bold">Informasi pihak</h4>

            <p><b>Nama :</b> {{$pihak->nama}}<br>
            <b>Alamat :</b> {{$pihak->alamat}}<br>
            <b>NIK :</b> @if($pihak->nomor_indentitas <> "")<span>$pihak->nomor_indentitas</span> @else <span>-</span> @endif<br>
            <b>Tempat / Tanggal lahir : </b>@if($pihak->tempat_lahir <> "")<span>{{$pihak->tempat_lahir}}</span> @else <span>-</span> @endif / @if($pihak->tanggal_lahir <> '0000-00-00')<span>{{$pihak->tanggal_lahir}}</span> @else <span>-</span> @endif<br>
            <b>Jenis kelamin :</b>  @if($pihak->jenis_kelamin == 'L')<span>Laki-laki</span>@elseif($pihak->jenis_kelamin == 'P')<span>Perempuan</span>@else<span>-</span>@endif
        </p>
            
            <h4 style="font-weight:bold">Lampiran</h4>
            <p>
                <b>KTP Lama :</b>  <span class="badge rounded-pill bg-success">Lihat</span><br>
                <b>Akta Cerai :</b>  <span class="badge rounded-pill bg-success">Lihat</span>
            </p>
            <button class="btn btn-primary btn-sm">Lengkapi data</button> <button class="btn btn-success btn-sm">Kirim permohonan</button>
        </div>
    </div>
</div>
@endsection
