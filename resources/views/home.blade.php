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

                @foreach($perkara as $row)
                <table class="table table-sm">
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
                    <tr>
                        <td class="table-warning">{{$row->perkara_id}}</td>
                        <td class="table-warning">{{$row->tanggal_pendaftaran}}</td>
                        <td class="table-warning">{{$row->jenis_perkara_text}}</td>
                        <td class="table-warning">{{$row->nomor_perkara}}</td>
                        <td class="table-warning">{{$row->tahapan_terakhir_text}}</td>
                        <td class="table-warning" colspan="4">{{$row->nomor_akta_cerai}}</td>
                    </tr>
                <table class="table table-borderless table-sm">
                
                    <tr>
                        <th style="width:30px"></th><th class="table-info" width="80px">ID Pihak</th><th class="table-info">Nama</th><th class="table-info">Alamat</th><th class="table-info" style="width:100px">Jenis kelamin</th><th class="table-info" style="width:100px">No. Identitas</th><th class="table-info" style="width:80px">No. Telp.</th><th class="table-info">Pekerjaan</th>
                    </tr>
                
                    @foreach($para_pihak as $baris)
                        @if($baris->perkara_id == $row->perkara_id)
                            <tr>
                                <td></td>
                                <td class="table-success">{{$baris->pihak_id}}</td>
                                <td class="table-success">{{$baris->nama}}</td>
                                <td class="table-success">{{$baris->alamat}}</td>
                                @foreach($pihak_info as $row_pihak_info)
                                    @if($row_pihak_info->id == $baris->pihak_id)
                                        <td class="table-success">{{$row_pihak_info->jenis_kelamin}}</td>
                                        <td class="table-success">{{$row_pihak_info->nomor_indentitas}}</td>
                                        <td class="table-success">{{$row_pihak_info->telepon}}</td>
                                        <td class="table-success">{{$row_pihak_info->pekerjaan}}</td>
                                    @endif
                                @endforeach
                            </tr>
                        @endif
                    @endforeach
                @endforeach
            </table>
            </table>
        </div>
    </div>
</div>
@endsection
