@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">Detail user</div>

        <div class="card-body">
            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <table style="margin-bottom:10px">
                <tr>
                    <td align="right"><b>Nama</b></td>
                    <td>:</td>
                    <td>{{$table->name}}</td>
                </tr>
                <tr>
                    <td align="right"><b>Username</b></td>
                    <td>:</td>
                    <td>{{$table->username}}</td>
                </tr>
                <tr>
                    <td align="right"><b>Email</b></td>
                    <td>:</td>
                    <td>{{$table->email}}</td>
                </tr>
                <tr>
                    <td align="right"><b>No. Telp.</b></td>
                    <td>:</td>
                    <td>{{$table->no_telp}}</td>
                </tr>
                <tr>
                    <td align="right"><b>Role</b></td>
                    <td>:</td>
                    <td>
                        @switch($table->id_role)
                            @case(0)
                                <span class="badge rounded-pill bg-primary text-white">{{$table->role}}</span>
                            @break

                            @case(1)
                                <span class="badge rounded-pill bg-primary text-white">{{$table->role}}</span>
                            @break

                            @case(2)
                                <span class="badge rounded-pill bg-warning">{{$table->role}}</span>
                            @break

                            @case(3)
                                <span class="badge rounded-pill bg-success text-white">{{$table->role}}</span>
                            @break

                            @default
                                <span class="badge rounded-pill bg-danger text-white">{{$table->role}}</span>

                            
                        @endswitch
                        
                    </td>
                </tr>
                <tr>
                    <td align="right"><b>Status</b></td>
                    <td>:</td>
                    <td>{{$table->status}}</td>
                </tr>
            </table>
            
            <a class="btn btn-primary btn-sm" href="{{route('users.edit', ['id_user'=>$table->id_user])}}">Ubah</a>
            <a class="btn btn-success btn-sm" href="{{route('users.reset', ['id_user'=>$table->id_user])}}">Reset password</a>
            @if(Auth::user()->role_id == 0 )
             <button class="btn btn-danger btn-sm hapus" >Hapus</button>
            @endif 
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript" >
    $(document).ready(function(){
        $("body").on("click",".hapus", function(){
            if(window.confirm("Anda yakin ingin menghapus data ini?")){
                $.ajax({
                    url:"{{route('users.delete', ['id_user'=>$table->id_user])}}",
                    type:"GET",
                    success:function(data){
                        window.location.href = "{{route('users.index')}}";
                        //console.log("Kirim");
                    }
                });
            }
        });

    });
</script>
@endpush
