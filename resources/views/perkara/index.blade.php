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
            <p>Daftar putusan perkara</p>
            <div style="overflow-x:auto;">
                @foreach($sql as $row)
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
                        <td class="table-warning">{{$row->tahapan_terakhir_text}}</td>
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
                            <tr>
                                <td>{{$row->id_pihak1}}</td>
                                <td>{{$row->nama_pihak1}}</td>
                                <td>{{$row->alamat_pihak1}}</td>
                                <td>{{$row->jenis_kelamin1}}</td>
                                <td>{{$row->no_identitas1}}</td>
                                <td>
                                @switch($row->id_status1)
                                    @case(1)
                                        <span class="badge rounded-pill bg-success text-white">{{$row->status_pengajuan1}}</span>
                                    @break

                                    @case(2)
                                        <span class="badge rounded-pill bg-primary text-white">{{$row->status_pengajuan1}}</span>
                                    @break

                                    @case(3)
                                        <span class="badge rounded-pill bg-danger text-white">{{$row->status_pengajuan1}}</span>
                                    @break

                                    @default
                                        <span></span>
                                @endswitch
                                </td>
                            </tr>
                            <tr>
                                <td colspan="6">
                                    @if(Auth::user()->role_id <> 1)
                                        <a href="{{route('perkara.pengajuan', ['id_pihak'=>$row->id_pihak1, 'id_perkara'=>$row->perkara_id])}}" class="btn btn-primary btn-sm">Ajukan Pemutakhiran Data Kependudukan</a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>{{$row->id_pihak2}}</td>
                                <td>{{$row->nama_pihak2}}</td>
                                <td>{{$row->alamat_pihak2}}</td>
                                <td>{{$row->jenis_kelamin2}}</td>
                                <td>{{$row->no_identitas2}}</td>
                                <td>
                                @switch($row->id_status2)
                                    @case(1)
                                        <span class="badge rounded-pill bg-success text-white">{{$row->status_pengajuan2}}</span>
                                    @break

                                    @case(2)
                                        <span class="badge rounded-pill bg-primary text-white">{{$row->status_pengajuan2}}</span>
                                    @break

                                    @case(3)
                                        <span class="badge rounded-pill bg-danger text-white">{{$row->status_pengajuan2}}</span>
                                    @break

                                    @default
                                        <span></span>
                                @endswitch
                                </td>
                            </tr>
                            <tr>
                                <td colspan="6">
                                    @if(Auth::user()->role_id <> 1)
                                        <a href="{{route('perkara.pengajuan', ['id_pihak'=>$row->id_pihak2, 'id_perkara'=>$row->perkara_id])}}" class="btn btn-primary btn-sm">Ajukan Pemutakhiran Data Kependudukan</a>
                                    @endif
                                </td>
                            </tr>
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
