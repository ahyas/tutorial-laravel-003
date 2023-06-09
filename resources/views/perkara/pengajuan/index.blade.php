@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">Pengajuan perubahan data status perkwinan</div>
        <div class="card-body">
        <p>Pastikan seluruh data sudah lengkap untuk mengajukan perubahan data status perkawinan</p>
        @if($pihak->status_pengajuan == 1)
            <div class="alert alert-success" role="alert">
                Data ini sudah diajukan.
            </div>
            <?php $btn_lengkapi = "disabled"; ?>
            <?php $btn_kirim = "disabled"; ?>
        @else
            @if($pihak->alamat == "" || $pihak->nama == "" || $pihak->nomor_indentitas == "" )
                <div class="alert alert-danger" role="alert">
                    Ada data yang belum lengkap, silahkan lengkapi terlebih dahulu.
                </div>
                <?php $btn_lengkapi = ""; ?>
                <?php $btn_kirim = "disabled"; ?>
            @else
                <?php $btn_lengkapi = ""; ?>
                <?php $btn_kirim = ""; ?>
            @endif
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
                <td align="left" colspan="2">Semula Kawin, Menjadi Cerai hidup</td>
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