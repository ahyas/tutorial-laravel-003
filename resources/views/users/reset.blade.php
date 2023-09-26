@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">Reset password</div>

        <div class="card-body">
        
        <form action="{{route('users.update_password', ['id_user'=>$table->id_user])}}" method="POST">
        {{ csrf_field() }}
            <div class="mb-3">
                <label class="form-label"><b>Password Lama</b></label>
                <input type="password" class="form-control" name="current_pass" placeholder="Password Lama" value="">
                @if($errors->has('current_pass'))
                    <span class="text-danger">{{$errors->first('current_pass')}}</span>
                @endif
            </div>
            <div class="mb-3">
                <label class="form-label"><b>Password Baru</b></label>
                <input type="password" class="form-control" name="new_pass" placeholder="Password baru" value="">
                @if($errors->has('new_pass'))
                    <span class="text-danger">{{$errors->first('new_pass')}}</span>
                @endif
            </div>
            <div class="mb-3">
                <label class="form-label"><b>Konfirmasi Password Baru</b></label>
                <input type="password" class="form-control" name="confirm_new_pass" placeholder="Konfirmasi Password Baru" value="">
                @if($errors->has('confirm_new_pass'))
                    <span class="text-danger">{{$errors->first('confirm_new_pass')}}</span>
                @endif
            </div>

            <div class="form-group">
                <a class="btn btn-danger btn-sm" href="{{URL::previous()}}">Kembali</a> <button type="submit" class="btn btn-primary btn-sm">Reset</button>
            </div>
            
            
        </form>
        </div>
    </div>
</div>
@endsection