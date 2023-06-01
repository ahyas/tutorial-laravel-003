@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">{{ __('Dashboard') }}</div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div style="overflow-x:auto;">
                @foreach($perkara as $row)
                <table class="table table-borderless table-sm" style="font-size:13px;">
                <thead class="thead-dark">
                    <tr>
                        <th>ID Perkara</th>
                        <th>Tanggal pendaftaran</th>
                        <th>Jenis perkara</th>
                        <th>Nomor perkara</th>
                        <th>Tahapan terakhir</th>
                        <th colspan="4">No. Akta cerai</th>
                    </tr>
                </thead>
                    <tr style="font-weight:bold">
                        <td class="table-warning">{{$row->perkara_id}}</td>
                        <td class="table-warning">{{$row->tanggal_pendaftaran}}</td>
                        <td class="table-warning">{{$row->jenis_perkara_text}}</td>
                        <td class="table-warning">{{$row->nomor_perkara}}</td>
                        <td class="table-warning">
                            @if($row->tahapan_terakhir_id == 19)
                                <span class="badge rounded-pill bg-success">{{$row->tahapan_terakhir_text}}</span>
                            @else
                                <span class="badge rounded-pill bg-warning text-dark">{{$row->tahapan_terakhir_text}}</span>
                            @endif
                        </td>
                        <td class="table-warning" colspan="4">{{$row->nomor_akta_cerai}}</td>
                    </tr>
                <tr>
                    <td class="table-warning" colspan="9">Detail para pihak</td>
                </tr>
                <tr>
                    <td colspan=9 class="table-warning">
                        <table class="table table-borderless table-sm" >
                            <tr>
                                <th class="table-info" width="80px">ID Pihak</th>
                                <th class="table-info">Nama</th>
                                <th class="table-info">Alamat</th>
                                <th class="table-info" style="width:100px">Jenis kelamin</th>
                                <th class="table-info" style="width:100px">No. Identitas</th>
                                <th class="table-info" style="width:120px">Status</th>
                                <!--<th class="table-info" style="width:80px">No. Telp.</th>
                                <th class="table-info">Pekerjaan</th>-->
                            </tr>
                        
                        @foreach($para_pihak as $baris)
                            @if($baris->perkara_id == $row->perkara_id)
                                <tr>
                                    <td class="table-success">{{$baris->pihak_id}}</td>
                                    <td class="table-success">{{$baris->nama}}</td>
                                    <td class="table-success">{{$baris->alamat}}</td>
                                    @foreach($pihak_info as $row_pihak_info)
                                        @if($row_pihak_info->id == $baris->pihak_id)
                                            <td class="table-success">
                                                @if($row_pihak_info->jenis_kelamin == 'L')
                                                    <span>Laki-laki</span>
                                                @else
                                                    <span>Perempuan</span>
                                                @endif
                                            </td>
                                            <td class="table-success">{{$row_pihak_info->nomor_indentitas}}</td>
                                            <td class="table-success"></td>
                                            <!--<td class="table-success">{{$row_pihak_info->telepon}}</td>
                                            <td class="table-success">{{$row_pihak_info->pekerjaan}}</td>-->
                                        @endif
                                    @endforeach
                                </tr>
                                <tr class="table-success">
                                    <td colspan="7" style="padding-bottom:10px">
                                        @if(Auth::user()->role_id <> 1)
                                            @if($row->nomor_akta_cerai <> "")
                                                <a href="{{route('perkara.pengajuan', ['id_pihak'=>$baris->pihak_id])}}" class="btn btn-primary btn-sm">Ajukan perubahan data kependudukan</a>
                                            @else
                                                <button class="btn btn-primary btn-sm" disabled>Ajukan perubahan data kependudukan</button>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </table>
                    </td>
                </tr>
                </table>
                @endforeach
        </div>
        </div>
    </div>
</div>
@endsection
