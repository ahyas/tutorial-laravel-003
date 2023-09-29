@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">Pembaharuan data user</div>

        <div class="card-body">
        
        <form action="{{route('users.update', ['id_user'=>$table->id_user])}}" method="POST">
        {{ csrf_field() }}
            <div class="mb-3">
                <label class="form-label"><b>Nama</b></label>
                <input type="text" class="form-control" placeholder="Nama lengkap" name="name" value="{{$table->name}}" autofocus>
            </div>
            <div class="mb-3">
                <label class="form-label"><b>Email</b></label>
                <input type="text" class="form-control" name="email" placeholder="Email" value="{{$table->email}}">
            </div>
            <div class="mb-3">
                <label class="form-label"><b>No. Telp.</b></label>
                <input type="text" class="form-control" name="no_telp" placeholder="Nomor Telpon" value="{{$table->no_telp}}">
            </div>

            @if(Auth::user()->role_id == 0)
            
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label><b>Role</b></label>
                    <select class="form-control" name="role_id" id="role_id">
                        <option value="0">Pilih role user</option>
                        @foreach($roles as $row)
                            <option value="{{$row->id}}" <?php if ($row->id == $table->id_role) echo"selected"; ?> >{{$row->role}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                <label><b>Satker Induk</b></label>
                <select class="form-control" name="satker_induk" id="satker_induk">
                    <option value="0">Pilih Satker Induk</option>
                    @foreach($satker_induk as $row)
                        <option value="{{$row->id}}" <?php if ($row->id == $table->satker_induk) echo"selected";?> >{{$row->satker_induk}}</option>
                    @endforeach
                </select>
                </div>
                <div class="form-group col-md-4">
                <label><b>Satker anak</b></label>
                    <select class="form-control" name="satker_anak" id="satker_anak">
                        <option value="0">Pilih Satker Anak</option>
                        @foreach($satker_anak as $row)
                            <option value="{{$row->id}}" <?php if ($row->id == $table->satker_anak) echo"selected";?> >{{$row->satker_anak}}</option>
                        @endforeach
                    </select>
                </div>
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
            @endif
            <a class="btn btn-danger btn-sm" href="{{URL::previous()}}">Kembali</a> <button type="submit" class="btn btn-primary btn-sm">Update</button>
        </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript" >
    $(document).ready(function(){
        var a = "{{$table->id_role}}";
       
        function setFieldActivation(id){

            if(id==1){
                
                document.getElementById("satker_induk").disabled = false;
                document.getElementById("satker_anak").disabled = true;
            }else if(id==2 || id==3){
                
                document.getElementById("satker_induk").disabled = false;
                document.getElementById("satker_anak").disabled = false;
            }else{
                
                document.getElementById("satker_induk").disabled = true;
                document.getElementById("satker_anak").disabled = true;
            }
        }

        setFieldActivation(a);


        $("#role_id").change(function(){
            var id_role = $(this).val();
            document.getElementById("satker_induk").value = 0
            document.getElementById("satker_anak").value = 0
            setFieldActivation(id_role);
            $.ajax({
                url:"/semar/satker_induk/"+id_role,
                type:"GET",
                success:function(data){
                    console.log(data);
                    var satker_induk=document.getElementById("satker_induk");
                    
                    for(var a=satker_induk.options.length; a>=1; a--){
                        satker_induk.remove(a);
                    }

                    for(var i=0; i<data.length; i++){
                        console.log(data[i].satker_induk)
                        var option = document.createElement("option");
                        option.text = data[i].satker_induk;
                        option.value = data[i].id;
                        
                        satker_induk.appendChild(option);
                    }
                    
                }
            });
        });

        $("#satker_induk").change(function(){
            var id_induk = $(this).val();
            console.log("Id induk ", id_induk);
            $.ajax({
                url:"/semar/satker_anak/"+id_induk,
                type:"GET",
                success:function(data){
                    console.log(data);
                    var satker_anak=document.getElementById("satker_anak");
                    
                    for(var a=satker_anak.options.length; a>=1; a--){
                        satker_anak.remove(a);
                    }

                    for(var i=0; i<data.length; i++){
                        
                        var option = document.createElement("option");
                        option.text = data[i].nama;
                        option.value = data[i].id;
                        
                        satker_anak.appendChild(option);
                    }
                    
                }
            });
        });
    });
</script>
@endpush
