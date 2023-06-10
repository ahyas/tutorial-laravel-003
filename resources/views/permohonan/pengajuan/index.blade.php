@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">Pengajuan perubahan data status perkwinan</div>
        <div class="card-body">
        <p>Pastikan seluruh data sudah lengkap untuk mengajukan perubahan data status perkawinan</p>
        @if($pihak->status_pengajuan == 2)
            <div class="alert alert-info" role="alert">
                <b>Data ini sedang diproses.</b>
            </div>
            <?php $btn_proses = "disabled"; ?>
            <?php $btn_selesai = ""; ?>
        @elseif($pihak->status_pengajuan == 3)
            <div class="alert alert-warning" role="alert">
                <b>Data ini telah selesai diproses.</b>
            </div>
            <?php $btn_proses = "disabled"; ?>
            <?php $btn_selesai = "disabled"; ?>
        @else
            <?php $btn_proses = ""; ?>
            <?php $btn_selesai = "disabled"; ?>
        @endif
        <table style="margin-bottom:15px">
            <tr>
                <td align="left"><b>Nama :</b></td>
                <td>{{$pihak->nama}}</td>
            </tr>
            <tr>
                <td align="left"><b>Alamat :</b></td>
                <td>{{$pihak->alamat}}</td>
            </tr>
            <tr>
                <td align="left"><b>NIK :</b></td>
                <td>{{$pihak->nomor_indentitas}}</td>
            </tr>
            <tr>
                <td align="left"><b>Jenis kelamin :</b></td>
                <td>@if($pihak->jenis_kelamin == 'P') Perempuan @else Laki-laki @endif</td>
            </tr>
        </table>
        <span>Data yang akan diubah adalah status perkawinan</span>
        <table style="margin-bottom:15px">
            <tr>
                <td align="left" colspan="2">Semula <b>Kawin</b>, Menjadi <b>Cerai hidup</b></td>
            </tr>
            <tr>
                <td align="left"><b>Dasar perubahan :</b></td>
                <td>Akta Cerai No. {{$akta_cerai->nomor_akta_cerai}} Tanggal {{$akta_cerai->tgl_akta_cerai}}</td>
            </tr>
        </table>
        
        <a class="btn btn-danger btn-sm" href="{{url('/permohonan')}}">Batal</a>
        <button class='btn btn-primary btn-primary btn-sm proses' <?php echo $btn_proses; ?> >Proses</button>
        <button class='btn btn-primary btn-success btn-sm selesai'<?php echo $btn_selesai; ?> >Selesai</button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript" >
    $(document).ready(function(){
        $("body").on("click",".proses", function(){
            if(window.confirm("Apakah semua data telah sesuai?")){
                $.ajax({
                    url:"{{route('permohonan.pengajuan.proses', ['id_perkara'=>$akta_cerai->perkara_id, 'id_pihak'=>$pihak->pihak_id])}}",
                    type:"GET",
                    data:{status:2},
                    success:function(data){
                        window.location.href = "{{route('permohonan.index')}}";
                        //console.log("Kirim");
                    }
                });
            }
        });

        $("body").on("click",".selesai",function(){
            if(window.confirm("Apakah semua data telah sesuai?")){
                $.ajax({
                    url:"{{route('permohonan.pengajuan.selesai', ['id_perkara'=>$akta_cerai->perkara_id, 'id_pihak'=>$pihak->pihak_id])}}",
                    type:"GET",
                    data:{status:3},
                    success:function(data){
                        window.location.href = "{{route('permohonan.index')}}";
                    }
                });
            }
        });
    });
</script>
@endpush
