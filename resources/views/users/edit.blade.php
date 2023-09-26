@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">Pengajuan perubahan data kependudukan</div>

        <div class="card-body">
        
        <form action="{{route('users.update', ['id_user'=>$table->id_user])}}" method="POST">
        {{ csrf_field() }}
            <div class="mb-3">
                <label class="form-label"><b>Nama</b></label>
                <input type="text" class="form-control" placeholder="Nama lengkap" name="nama" value="{{$table->name}}">
            </div>
            <div class="mb-3">
                <label class="form-label"><b>Email</b></label>
                <input type="text" class="form-control" name="email" placeholder="Email" value="{{$table->email}}">
            </div>
            <div class="mb-3">
                <label class="form-label"><b>No. Telp.</b></label>
                <input type="text" class="form-control" name="no_telp" placeholder="Nomor Telpon" value="{{$table->no_telp}}">
            </div>
            <div class="mb-3">
                <label class="form-label"><b>Role</b></label>
                <select class="form-control" name="role" <?php if(Auth::user()->role_id <> 0){echo"readonly";} ?> >
                    <option value="0">Pilih role user</option>
                    @foreach($roles as $row)
                        
                            <option value="{{$row->id}}" <?php if ($row->id == $table->id_role) echo"selected"; ?> >{{$row->role}}</option>
                        
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label"><b>Status</b></label>
                <select class="form-control" name="status" <?php if(Auth::user()->role_id <> 0){echo"readonly";} ?>>
                    <option value="0">Pilih status</option>
                    @foreach($status as $row)
                       
                            <option value="{{$row->id}}" <?php if ($row->id == $table->id_status) echo"selected"; ?>>{{$row->status}}</option>
                        
                    @endforeach
                </select>
            </div>
            <a class="btn btn-danger btn-sm" href="{{URL::previous()}}">Kembali</a> <button type="submit" class="btn btn-primary btn-sm">Update</button>
        </form>
        </div>
    </div>
</div>
@endsection
