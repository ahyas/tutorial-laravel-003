@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-striped border">
                        <tr>
                            <th>ID Perkara</th>
                            <th>Tanggal pendaftaran</th>
                            <th>Jenis perkara</th>
                            <th>Nomor perkara</th>
                            <th>Tahapan terakhir</th>
                        </tr>
                        @foreach($perkara as $row)
                        <tr>
                            <td>{{$row->perkara_id}}</td>
                            <td>{{$row->tanggal_pendaftaran}}</td>
                            <td>{{$row->jenis_perkara_text}}</td>
                            <td>{{$row->nomor_perkara}}</td>
                            <td>{{$row->tahapan_terakhir_text}}</td>
                        </tr>
                        
                            <tr>
                                <th></th><th>Pihak ID</th><th>Nama</th><th colspan="2">Alamat</th>
                            </tr>
                            @foreach($para_pihak as $baris)
                                @if($baris->perkara_id == $row->perkara_id)
                                    <tr>
                                        <td></td><td>{{$baris->pihak_id}}</td><td>{{$baris->nama}}</td><td colspan="2">{{$baris->alamat}}</td>
                                    </tr>
                                @endif
                            @endforeach
                        @endforeach
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
