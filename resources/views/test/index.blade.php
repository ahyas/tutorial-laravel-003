@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Test</div>

                <div class="card-body">
                    {{$test}}
                    <table border=1>
                        <tr>
                            <td>ID Perkara</td>
                            <td>Tanggal pendaftaran</td>
                            <td>Jenis perkara</td>
                            <td>Nomor perkara</td>
                            <td>Tahapan akhir</td>
                            <td>Nomor akta cerai</td>
                        </tr>
                    
                        @foreach($sql as $row)
                        <tr>
                            <td>{{$row->perkara_id}}</td>
                            <td>{{$row->tanggal_pendaftaran}}</td>
                            <td>{{$row->jenis_perkara_text}}</td>
                            <td>{{$row->nomor_perkara}}</td>
                            <td>{{$row->tahapan_terakhir_text}}</td>
                            <td>{{$row->nomor_akta_cerai}}</td>
                        </tr>
                        <tr>
                            <td colspan="6">{{$row->nama_pihak1}}</td>
                        </tr>
                        <tr>
                            <td colspan="6">{{$row->nama_pihak2}}</td>
                        </tr>
                        @endforeach
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
