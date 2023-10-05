@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">Pengajuan Pemutakhiran Data Kependudukan</div>
        <div class="card-body">
        <p>Pastikan seluruh data sudah lengkap untuk mengajukan perubahan data status perkawinan</p>

        @switch($pihak->status_pengajuan)
            @case(2)
                <?php $btn_proses = "disabled"; ?>
                <?php $btn_selesai = ""; ?>
            @break

            @case(3)
                <?php $btn_proses = "disabled"; ?>
                <?php $btn_selesai = "disabled"; ?>
            @break

            @default
                <?php $btn_proses = ""; ?>
                <?php $btn_selesai = "disabled"; ?>
            
        @endswitch
        
        <table style="margin-bottom:15px">
            <tr valign="top">
                <td align="right" width="120px"><b>Nama</b></td>
                <td width:5px>:</td>
                <td width="400px">{{$pihak->nama}}</td>
            </tr>
            <tr valign="top">
                <td align="right"><b>Alamat</b></td>
                <td width:5px>:</td>
                <td>{{$pihak->alamat}}</td>
            </tr>
            <tr valign="top">
                <td align="right"><b>Provinsi</b></td>
                <td width:5px>:</td>
                <td>{{$pihak->provinsi}}</td>
            </tr>
            <tr valign="top">
                <td align="right"><b>Kabupaten</b></td>
                <td width:5px>:</td>
                <td>{{$pihak->kabupaten}}</td>
            </tr>
            <tr valign="top">
                <td align="right"><b>NIK</b></td>
                <td width:5px>:</td>
                <td>{{$pihak->nomor_indentitas}}</td>
            </tr>
            <tr valign="top">
                <td align="right"><b>Nomor Telp.</b></td>
                <td width:5px>:</td>
                <td>{{$pihak->no_telp}}</td>
            </tr>
            <tr>
                <td align="right"><b>Jenis kelamin</b></td>
                <td width:5px>:</td>
                <td>@if($pihak->jenis_kelamin == 'P') Perempuan @else Laki-laki @endif</td>
            </tr>
        </table>
        <span>Data yang akan diubah adalah status perkawinan</span>
        <table style="margin-bottom:15px">
            <tr>
                <td align="left" colspan="2">Semula <b>Kawin</b>, Menjadi <b>Cerai hidup</b></td>
            </tr>
            <tr>
                <td align="left">Dasar perubahan </td>
                <td>Akta Cerai <b>No. {{$akta_cerai->nomor_akta_cerai}}</b> Tanggal <b>{{$akta_cerai->tgl_akta_cerai}}</b></td>
            </tr>
        </table>
        
        <a class="btn btn-danger btn-sm" href="{{url('/permohonan')}}">Batal</a>
        <button class='btn btn-primary btn-primary btn-sm proses' <?php echo $btn_proses; ?> >Proses</button>
        <button class='btn btn-primary btn-success btn-sm selesai' <?php echo $btn_selesai; ?> >Selesai</button>
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
