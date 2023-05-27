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

            <table class="table table-striped border" border="1">
                <tr>
                    <th>ID Perkara</th>
                    <th>Tanggal pendaftaran</th>
                    <th>Jenis perkara</th>
                    <th>Nomor perkara</th>
                    <th>Tahapan terakhir</th>
                    <th>No. Akta cerai</th>
                    <th></th>
                    <th></th>
                </tr>
                @foreach($perkara as $row)
                <tr>
                    <td>{{$row->perkara_id}}</td>
                    <td>{{$row->tanggal_pendaftaran}}</td>
                    <td>{{$row->jenis_perkara_text}}</td>
                    <td>{{$row->nomor_perkara}}</td>
                    <td>{{$row->tahapan_terakhir_text}}</td>
                    <td>{{$row->nomor_akta_cerai}}</td>
                    <td></td>
                    <td></td>
                </tr>
                
                    <tr>
                        <th></th><th>Pihak ID</th><th>Nama</th><th colspan="2">Alamat</th><th>No. Identitas</th><th>No. Telp.</th><th>Pekerjaan</th>
                    </tr>
                    @foreach($para_pihak as $baris)
                        @if($baris->perkara_id == $row->perkara_id)
                            <tr>
                                <td></td><td>{{$baris->pihak_id}}</td><td>{{$baris->nama}}</td><td colspan="2">{{$baris->alamat}}</td>
                                @foreach($pihak_info as $row_pihak_info)
                                    @if($row_pihak_info->id == $baris->pihak_id)
                                        <td>{{$row_pihak_info->nomor_indentitas}}</td>
                                        <td>{{$row_pihak_info->telepon}}</td>
                                        <td>{{$row_pihak_info->pekerjaan}}</td>
                                    @endif
                                @endforeach
                            </tr>
                        @endif
                    @endforeach
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection
