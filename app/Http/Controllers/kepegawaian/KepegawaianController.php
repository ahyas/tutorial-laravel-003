<?php

namespace App\Http\Controllers\kepegawaian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class KepegawaianController extends Controller
{
    public function index(){
        //menampilakan halaman awal saat mengakses aplikasi
        //Menampilkan tabel data pegawai
        $table=DB::table("tb_pegawai")->get();
        return view("kepegawaian/index", compact("table"));
    }
    
    public function add(){
        //Menampilkan form tambah data pegawai
        return view("kepegawaian/add");
    }
    
    public function save(Request $request){
        //menambahkan data baru kedalam database
        DB::table("tb_pegawai")
        ->insert([
            "nama"=>$request["nama_lengkap"],
            "alamat"=>$request["alamat"],
            "tanggal_lahir"=>$request["tanggal_lahir"],
            "jabatan"=>$request["jabatan"],
            "penghasilan"=>$request["penghasilan"]
        ]);

        return redirect('kepegawaian/index');
    }
    
    public function edit($id){
        $table=DB::table("tb_pegawai")
        ->where("id", $id)
        ->first();

        return view("kepegawaian/edit", compact("table"));
    }
    
    public function update(Request $request, $id){
        DB::table("tb_pegawai")
        ->where("id",$id)
        ->update([
            "nama"=>$request["nama_lengkap"],
            "alamat"=>$request["alamat"],
            "tanggal_lahir"=>$request["tanggal_lahir"],
            "jabatan"=>$request["jabatan"],
            "penghasilan"=>$request["penghasilan"]
        ]);

        return redirect('kepegawaian/index');
    }
    
    public function delete($id){
        DB::table("tb_pegawai")
        ->where("id", $id)
        ->delete();

        return redirect('kepegawaian/index');
    }
    
    public function find(Request $request){
        $table = DB::table("tb_pegawai")
        ->where('nama','like',"%".$request->kata_kunci."%")
        ->get();

        return view("kepegawaian/index", compact("table"));
    }
}
