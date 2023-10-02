@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">Detail para pihak</div>
        <div class="card-body">
        @if(Auth::user()->id == $pihak->pihak_id || Auth::user()->role_id!==4)
        
            @if($pihak->telepon == "" || $pihak->provinsi == "" || $pihak->kabupaten == "")
                <div class="alert alert-danger" role="alert">
                    Data belum lengkap, silahkan lengkapi terlebih dahulu.
                </div>
                <?php $btn_lengkapi = ""; ?>
                <?php $btn_kirim = "disabled"; ?>
                <?php $btn_kirim_pengajuan="disabled"; ?>
            @else

                @switch($pihak->status_pengajuan)
                    @case(1)
                        <div class="alert alert-success" role="alert">
                            <span>Data ini sudah diajukan ke Dinas Kependudukan dan Catatan Sipil.</span>
                        </div>
                        <?php $btn_lengkapi = "disabled"; ?>
                        <?php $btn_kirim = "disabled"; ?>
                        <?php $btn_kirim_pengajuan="disabled"; ?>
                    @break

                    @case(2)
                        <div class="alert alert-info" role="alert">
                            <span>Data ini sedang diproses untuk perubahan data kependudukan.</span>
                        </div>
                        <?php $btn_lengkapi = "disabled"; ?>
                        <?php $btn_kirim = "disabled"; ?>
                        
                    @break

                    @case(3)
                        <div class="alert alert-primary" role="alert">
                            <span>Data ini telah selesai dilakukan perubahan data kependudukan.</span>
                        </div>
                        <?php $btn_lengkapi = "disabled"; ?>
                        <?php $btn_kirim = "disabled"; ?>
                        <?php $btn_kirim_pengajuan = "disabled"; ?>
                    @break

                    @case(4)
                        @if(Auth::user()->role_id == 4)
                            <?php $btn_lengkapi = ""; ?>
                            <?php $btn_kirim = ""; ?>    
                            <?php $btn_kirim_pengajuan=""; ?>
                        @else
                        <div class="alert alert-warning" role="alert">
                            <span>Notifikasi telah terkirim</span>
                        </div>
                            <?php $btn_lengkapi = "disabled"; ?>
                            <?php $btn_kirim = "disabled"; ?>
                            
                        @endif
                    @break

                    @default
                        <?php $btn_lengkapi = ""; ?>
                        <?php $btn_kirim = ""; ?>
                        
                        
                @endswitch
            @endif
        @else
            <?php $btn_lengkapi = ""; ?>
            <?php $btn_kirim_pengajuan = ""; ?>
        @endif
        
        <table style="margin-bottom:15px">
            <tr valign="top">
                <td align="right" width="120px"><b>Nama</b></td>
                <td width:5px>:</td>
                <td width="400px"><span id="nama_pihak">{{$pihak->nama}}</span></td>
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
                <td><span id="no_telp">{{$pihak->telepon}}</span></td>
            </tr>
            <tr valign="top">
                <td align="right"><b>Jenis kelamin</b></td>
                <td width:5px>:</td>
                <td>@if($pihak->jenis_kelamin == 'P') Perempuan @elseif($pihak->jenis_kelamin == 'L') Laki-laki @endif</td>
            </tr>
        </table>
        
        <a class="btn btn-danger btn-sm" href="{{url('/perkara')}}">Kembali</a>
        
        
        @if( Auth::user()->role_id !==4 )
                    <button class="btn btn-primary btn-success btn-sm lengkapi" <?php echo $btn_lengkapi; ?>>Lengkapi data</button>
                    <button class="btn btn-primary btn-primary btn-sm kirim_notifikasi"  <?php echo $btn_kirim; ?>>Kirim notifikasi</button>
            @else
                @if(Auth::user()->id == $pihak->pihak_id)
                    <button class="btn btn-primary btn-success btn-sm lengkapi" <?php echo $btn_lengkapi; ?>>Lengkapi data</button>
                    <button class="btn btn-primary btn-primary btn-sm kirim_pengajuan" <?php echo $btn_kirim_pengajuan; ?>>Ajukan perubahan data kependudukan</button>
                @endif
            @endif
        
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

        $("body").on("click", ".kirim_pengajuan", function(){
           if(confirm("Dengan ini Saya menyatakan data yang telah Saya input telah benar dan bersedia mengajukan data tersebut untuk dikirim ke Dinas Kependudukan dan Catatan Sipil untuk dilakukan perubahan data status perkawinan dari Kawin menjadi Cerai Hidup")){
            console.log("Terkirim");
            $.ajax({
                url:"{{route('perkara.pengajuan.kirim_pengajuan', ['id_perkara'=>$akta_cerai->perkara_id, 'id_pihak'=>$pihak->pihak_id])}}",
                type:"GET",
                data:{status:1},
                success:function(data){
                    window.location.href = "{{route('perkara.index')}}";
                }
            })
           }
        });

        $("body").on("click",".lengkapi",function(){
            window.location.href= "{{route('perkara.pengajuan.edit', ['id_perkara'=>$akta_cerai->perkara_id, 'id_pihak'=>$pihak->pihak_id])}}";
        });

        $("body").on("click", ".kirim_notifikasi", function(){
            var nama_pihak = document.getElementById("nama_pihak").textContent;
            var no_telp = document.getElementById("no_telp").textContent;
            if(confirm("Anda yakin ingin mengirim notifikasi perkara ini?")){
                $.ajax({
                    url:"{{route('perkara.pengajuan.kirim_notifikasi', ['id_perkara'=>$akta_cerai->perkara_id, 'id_pihak'=>$pihak->pihak_id])}}",
                    type:"GET",
                    data:{status_pengajuan:4, status_user:1, nama_pihak:nama_pihak, no_telp:no_telp},
                    success:function(data){
                        window.location.href = "{{route('perkara.index')}}";
                    }
                });
            }
        });
    });
</script>
@endpush
