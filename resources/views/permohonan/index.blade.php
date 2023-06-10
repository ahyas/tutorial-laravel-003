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
                                <span class="badge rounded-pill bg-success text-white">{{$row->tahapan_terakhir_text}}</span>
                            @else
                                <span class="badge rounded-pill bg-warning text-dark">{{$row->tahapan_terakhir_text}}</span>
                            @endif
                        </td>
                        <td class="table-warning" colspan="4">{{$row->nomor_akta_cerai}}</td>
                    </tr>
                <tr>
                    <td class="table-warning" colspan="9">Detail informasi para pihak</td>
                </tr>
                <tr>
                    <td colspan=9 class="table-warning">
                        <table class="table table-borderless table-sm" >
                            <tr>
                                <th class="table-info" width="80px">ID Pihak</th>
                                <th class="table-info" width="180px">Nama</th>
                                <th class="table-info">Alamat</th>
                                <th class="table-info" style="width:100px">Jenis kelamin</th>
                                <th class="table-info" style="width:100px">No. Identitas</th>
                                <th class="table-info" style="width:250px">Status pengajuan data kependudukan</th>
                                <!--<th class="table-info" style="width:80px">No. Telp.</th>
                                <th class="table-info">Pekerjaan</th>-->
                            </tr>
                        
                        @foreach($para_pihak as $baris)
                            @if($baris->perkara_id == $row->perkara_id)
                                    @foreach($pihak_info as $row_pihak_info)
                                        @if($row_pihak_info->id == $baris->pihak_id)
                                        <tr>
                                            <td class="table-success">{{$row_pihak_info->id}}</td>
                                            <td class="table-success">{{$row_pihak_info->nama}}</td>
                                            <td class="table-success">{{$row_pihak_info->alamat}}</td>
                                                <td class="table-success">
                                                    @if($row_pihak_info->jenis_kelamin == 'L')
                                                        <span>Laki-laki</span>
                                                    @else
                                                        <span>Perempuan</span>
                                                    @endif
                                                </td>
                                                <td class="table-success">{{$row_pihak_info->nomor_indentitas}}</td>
                                                <td class="table-success">
                                                    @foreach($status_pengajuan as $row_status)
                                                        @if($row_status->id == $row_pihak_info->status_pengajuan)
                                                            @if($row_pihak_info->status_pengajuan == 1)
                                                                <span class="badge rounded-pill bg-success text-white">{{$row_status->status}}</span>
                                                            @else
                                                                <span class="badge rounded-pill bg-primary text-white">{{$row_status->status}}</span>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <!--<td class="table-success">{{$row_pihak_info->telepon}}</td>
                                                <td class="table-success">{{$row_pihak_info->pekerjaan}}</td>-->
                                            </tr>
                                            <tr class="table-success">
                                                <td colspan="7" style="padding-bottom:10px">
                                                    <a href="{{route('permohonan.pengajuan', ['id_pihak'=>$baris->pihak_id, 'id_perkara'=>$row->perkara_id])}}" class="btn btn-primary btn-sm">Proses permohonan perubahan data</a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
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
