<?php

namespace App\Http\Controllers\kepegawaian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;

class KepegawaianController extends Controller
{
    public function index(){
        //menampilakan halaman awal saat mengakses aplikasi
        //Menampilkan tabel data pegawai
        $table=DB::table("tb_pegawai_003")->get();
        return view("kepegawaian/index", compact("table"));
    }
    
    public function add(){
        //Menampilkan form tambah data pegawai
        return view("kepegawaian/add");
    }
    
    public function save(Request $request){
        $request->validate([
            'nama_lengkap' => 'required',
            'alamat' => 'required',
            'email' => 'required|email|unique:tb_pegawai_003',
            'tanggal_lahir' => 'required|date_format:Y-m-d',
            'jabatan' => 'required'
        ], [
            'nama_lengkap.required' => 'Nama tidak boleh kosong',
            'alamat.required' => 'Alamat tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Alamat email tidak valid',
            'email.unique' => 'Alamat email sudah pernah dipakai',
            'tanggal_lahir.required' => 'Tanggal lahir tidak boleh kosong',
            'tanggal_lahir.date_format' => 'Format tanggal salah',
            'jabatan.required' => 'Jabatan tidak boleh kosong'
        ]);

        //Bila validasi berhasil simpan data baru kedalam database
        DB::table("tb_pegawai_003")
        ->insert([
            "nama"=>$request["nama_lengkap"],
            "alamat"=>$request["alamat"],
            "email"=>$request["email"],
            "tanggal_lahir"=>$request["tanggal_lahir"],
            "jabatan"=>$request["jabatan"],
        ]);

        Session::flash('success', 'Data berhasil di tambahkan');

        return redirect('kepegawaian/index');
    }
    
    public function edit($id){
        $table=DB::table("tb_pegawai_003")
        ->where("id", $id)
        ->first();

        return view("kepegawaian/edit", compact("table"));
    }
    
    public function update(Request $request, $id){
        $request->validate([
            'nama_lengkap' => 'required',
            'alamat' => 'required',
            'email' => 'required|email',
            'tanggal_lahir' => 'required|date_format:Y-m-d',
            'jabatan' => 'required'
        ], [
            'nama_lengkap.required' => 'Nama tidak boleh kosong',
            'alamat.required' => 'Alamat tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Alamat email tidak valid',
            'tanggal_lahir.required' => 'Tanggal lahir tidak boleh kosong',
            'tanggal_lahir.date_format' => 'Format tanggal salah',
            'jabatan.required' => 'Jabatan tidak boleh kosong'
        ]);

        DB::table("tb_pegawai_003")
        ->where("id",$id)
        ->update([
            "nama"=>$request["nama_lengkap"],
            "alamat"=>$request["alamat"],
            "email"=>$request["email"],
            "tanggal_lahir"=>$request["tanggal_lahir"],
            "jabatan"=>$request["jabatan"],
        ]);

        Session::flash('success', 'Data berhasil diubah');

        return redirect('kepegawaian/index');
    }
    
    public function delete($id){
        DB::table("tb_pegawai_003")
        ->where("id", $id)
        ->delete();
        Session::flash('success', 'Data berhasil dihapus');
        return redirect('kepegawaian/index');
    }
    
    public function find(Request $request){
        $table = DB::table("tb_pegawai_003")
        ->where('nama','like',"%".$request->kata_kunci."%")
        ->get();

        $count = $table->count();

        Session::flash('success', $count.' Data berhasil ditemukan');
        return view("kepegawaian/index", compact("table"));
    }
}
