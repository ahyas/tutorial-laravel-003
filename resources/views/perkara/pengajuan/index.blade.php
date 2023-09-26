@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">Pengajuan Pemutakhiran Data Kependudukan</div>
        <div class="card-body">
        
        @switch($pihak->status_pengajuan)
            @case(1)
                <div class="alert alert-success" role="alert">
                    <b>Data ini sudah diajukan.</b>
                </div>
                <?php $btn_lengkapi = "disabled"; ?>
                <?php $btn_kirim = "disabled"; ?>
            @break

            @case(2)
                <div class="alert alert-info" role="alert">
                    <b>Data ini sedang diproses.</b>
                </div>
                <?php $btn_lengkapi = "disabled"; ?>
                <?php $btn_kirim = "disabled"; ?>
            @break

            @case(3)
                <div class="alert alert-primary" role="alert">
                    <b>Data ini telah disetujui.</b>
                </div>
                <?php $btn_lengkapi = "disabled"; ?>
                <?php $btn_kirim = "disabled"; ?>
            @break

            @default
                @if($pihak->alamat == "" || $pihak->nama == "" || $pihak->nomor_indentitas == "" || $pihak->jenis_kelamin == "")
                    <div class="alert alert-danger" role="alert">
                        Ada data yang belum lengkap, silahkan lengkapi terlebih dahulu.
                    </div>
                    <?php $btn_lengkapi = ""; ?>
                    <?php $btn_kirim = "disabled"; ?>
                @else
                    <?php $btn_lengkapi = ""; ?>
                    <?php $btn_kirim = ""; ?>
                @endif
        @endswitch
        <p>Pastikan seluruh data sudah lengkap untuk mengajukan perubahan data status perkawinan</p>
        <table style="margin-bottom:15px">
            <tr>
                <td align="right" width="120px"><b>Nama</b></td>
                <td width:5px>:</td>
                <td>{{$pihak->nama}}</td>
            </tr>
            <tr>
                <td align="right"><b>Alamat</b></td>
                <td width:5px>:</td>
                <td>{{$pihak->alamat}}</td>
            </tr>
            <tr>
                <td align="right"><b>NIK</b></td>
                <td width:5px>:</td>
                <td>{{$pihak->nomor_indentitas}}</td>
            </tr>
            <tr>
                <td align="right"><b>Jenis kelamin</b></td>
                <td width:5px>:</td>
                <td>@if($pihak->jenis_kelamin == 'P') Perempuan @elseif($pihak->jenis_kelamin == 'L') Laki-laki @endif</td>
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
        
        <a class="btn btn-danger btn-sm" href="{{url('/perkara')}}">Batal</a>
        <button class="btn btn-primary btn-success btn-sm lengkapi" <?php echo $btn_lengkapi; ?>>Lengkapi data</button>
        <button class='btn btn-primary btn-primary btn-sm kirim' <?php echo $btn_kirim; ?>>Kirim</button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript" >
    $(document).ready(function(){
        $("body").on("click",".kirim", function(){
            if(window.confirm("Apakah semua data sudah benar?")){
                $.ajax({
                    url:"{{route('perkara.pengajuan.kirim', ['id_perkara'=>$akta_cerai->perkara_id, 'id_pihak'=>$pihak->pihak_id])}}",
                    type:"GET",
                    data:{status:1},
                    success:function(data){
                        window.location.href = "{{route('perkara.index')}}";
                        //console.log("Kirim");
                    }
                });
            }
        });

        $("body").on("click",".lengkapi",function(){
            window.location.href= "{{route('perkara.pengajuan.edit', ['id_perkara'=>$akta_cerai->perkara_id, 'id_pihak'=>$pihak->pihak_id])}}";
        });
    });
</script>
@endpush
