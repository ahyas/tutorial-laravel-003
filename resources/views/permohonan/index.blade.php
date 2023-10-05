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
            
            <p>Daftar permohonan pemutakhiran data kependudukan</p>
            <div style="overflow-x:auto;">
            <table class="table table-striped table-sm" >
                <tr class="table-info">
                    <th width="180px">Nama</th>
                    <th >Alamat</th>
                    <th style="width:120px">Nomor Telp.</th>
                    <th style="width:100px">Jenis kelamin</th>
                    <th style="width:100px">No. Identitas</th>
                    <th style="width:100px">Status</th>
                </tr>
                @foreach($sql as $row)
                    @if($row->id_status1 == 1 || $row->id_status1 == 2 || $row->id_status1 == 3)
                        @if($row->satker_anak1 == Auth::user()->satker_anak && $row->satker_induk1 == Auth::user()->satker_induk)
                            <tr>
                                <td>{{$row->nama_pihak1}}</td>
                                <td>{{$row->alamat_pihak1}}</td>
                                <td>{{$row->no_telp1}}</td>
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
                                    @if(Auth::user()->role_id == 3)
                                        <a href="{{route('permohonan.pengajuan', ['id_pihak'=>$row->id_pihak1, 'id_perkara'=>$row->perkara_id])}}" class="btn btn-primary btn-sm">Detail</a>
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endif

                    @if($row->id_status2 == 1 || $row->id_status2 == 2 || $row->id_status2 == 3)
                    @if($row->satker_anak2 == Auth::user()->satker_anak && $row->satker_induk1 == Auth::user()->satker_induk)
                    <tr>
                        <td>{{$row->nama_pihak2}}</td>
                        <td>{{$row->alamat_pihak2}}</td>
                        <td>{{$row->no_telp2}}</td>
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
                            @if(Auth::user()->role_id == 3)
                                <a href="{{route('permohonan.pengajuan', ['id_pihak'=>$row->id_pihak2, 'id_perkara'=>$row->perkara_id])}}" class="btn btn-primary btn-sm">Detail</a>
                            @endif
                        </td>
                    </tr>
                    @endif
                    @endif
                        
                @endforeach
                </table>
                {{$sql->links()}}
        </div>
        </div>
    </div>
</div>
@endsection
