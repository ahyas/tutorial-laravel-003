<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Hash;

class PerkaraController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        //login sebagai end user
        if(Auth::user()->role_id == 4){
            $sql = DB::table("perkara")
            ->where("perkara.tahapan_terakhir_id", 19)
            ->where(function($query) {
                $query->where("c.id", Auth::user()->id)
                    ->WhereNotNull("c.status_pengajuan");
            })
            ->orwhere(function($query) {
                $query->where("d.id", Auth::user()->id)
                    ->WhereNotNull("d.status_pengajuan");
            })
            ->select(
                "perkara.perkara_id", 
                "perkara_pihak1.nama AS nama_pihak1",
                "perkara_pihak2.nama AS nama_pihak2", 
                "perkara_pihak1.pihak_id AS id_pihak1",
                "perkara_pihak2.pihak_id AS id_pihak2",  
                "perkara_pihak1.alamat AS alamat_pihak1",
                "perkara_pihak2.alamat AS alamat_pihak2",  
                "perkara.tanggal_pendaftaran", 
                "perkara.tahapan_terakhir_id", 
                "perkara.jenis_perkara_text", 
                "perkara.nomor_perkara", 
                "perkara.tahapan_terakhir_text", 
                "perkara_akta_cerai.nomor_akta_cerai", 
                "perkara_akta_cerai.tgl_akta_cerai",
                "perkara_akta_cerai.no_seri_akta_cerai",
                "c.jenis_kelamin AS jenis_kelamin1", 
                "d.jenis_kelamin AS jenis_kelamin2", 
                "c.telepon AS no_telp1", 
                "d.telepon AS no_telp2", 
                "c.nomor_indentitas AS no_identitas1", 
                "d.nomor_indentitas AS no_identitas2", 
                "a.status AS status_pengajuan1", 
                "b.status AS status_pengajuan2",
                "a.id AS id_status1", 
                "b.id AS id_status2",
                "e.jenis_kelamin AS jenis_kelamin1",
                "f.jenis_kelamin AS jenis_kelamin2"
            )->leftJoin("perkara_akta_cerai", "perkara.perkara_id","=","perkara_akta_cerai.perkara_id")
            ->join("perkara_pihak1", "perkara.perkara_id","=","perkara_pihak1.perkara_id")
            ->join("perkara_pihak2","perkara.perkara_id", "=", "perkara_pihak2.perkara_id")
            ->join("pihak AS c", "perkara_pihak1.pihak_id", "=", "c.id")
            ->join("pihak AS d", "perkara_pihak2.pihak_id", "=", "d.id")
            ->leftJoin("status_pengajuan AS a", "c.status_pengajuan", "=", "a.id")
            ->leftJoin("status_pengajuan AS b", "d.status_pengajuan", "=", "b.id")
            ->leftJoin("jenis_kelamin AS e", "c.jenis_kelamin", "=" ,"e.kode")
            ->leftJoin("jenis_kelamin AS f", "d.jenis_kelamin", "=" ,"f.kode")
            ->get();
        }else{
            $sql = DB::table("perkara")
            ->where("perkara.tahapan_terakhir_id", 19)
            ->select(
                "perkara.perkara_id", 
                "perkara_pihak1.nama AS nama_pihak1",
                "perkara_pihak2.nama AS nama_pihak2", 
                "perkara_pihak1.pihak_id AS id_pihak1",
                "perkara_pihak2.pihak_id AS id_pihak2",  
                "perkara_pihak1.alamat AS alamat_pihak1",
                "perkara_pihak2.alamat AS alamat_pihak2",  
                "perkara.tanggal_pendaftaran", 
                "perkara.tahapan_terakhir_id", 
                "perkara.jenis_perkara_text", 
                "perkara.nomor_perkara", 
                "perkara.tahapan_terakhir_text", 
                "perkara_akta_cerai.nomor_akta_cerai", 
                "perkara_akta_cerai.tgl_akta_cerai",
                "perkara_akta_cerai.no_seri_akta_cerai",
                "c.jenis_kelamin AS jenis_kelamin1", 
                "d.jenis_kelamin AS jenis_kelamin2", 
                "c.telepon AS no_telp1", 
                "d.telepon AS no_telp2", 
                "c.nomor_indentitas AS no_identitas1", 
                "d.nomor_indentitas AS no_identitas2", 
                "a.status AS status_pengajuan1", 
                "b.status AS status_pengajuan2",
                "a.id AS id_status1", 
                "b.id AS id_status2",
                "e.jenis_kelamin AS jenis_kelamin1",
                "f.jenis_kelamin AS jenis_kelamin2"
            )->leftJoin("perkara_akta_cerai", "perkara.perkara_id","=","perkara_akta_cerai.perkara_id")
            ->join("perkara_pihak1", "perkara.perkara_id","=","perkara_pihak1.perkara_id")
            ->join("perkara_pihak2","perkara.perkara_id", "=", "perkara_pihak2.perkara_id")
            ->join("pihak AS c", "perkara_pihak1.pihak_id", "=", "c.id")
            ->join("pihak AS d", "perkara_pihak2.pihak_id", "=", "d.id")
            ->leftJoin("status_pengajuan AS a", "c.status_pengajuan", "=", "a.id")
            ->leftJoin("status_pengajuan AS b", "d.status_pengajuan", "=", "b.id")
            ->leftJoin("jenis_kelamin AS e", "c.jenis_kelamin", "=" ,"e.kode")
            ->leftJoin("jenis_kelamin AS f", "d.jenis_kelamin", "=" ,"f.kode")
            ->get();
        }

        return view('perkara.index', compact("sql"));
    }

    public function detail($id_perkara, $id_pihak){
        $pihak = DB::table("pihak")
        ->where("pihak.id", $id_pihak)
        ->select("pihak.id AS pihak_id","pihak.tempat_lahir","pihak.tanggal_lahir","pihak.jenis_kelamin","pihak.nomor_indentitas","pihak.nama","alamat","pihak.status_pengajuan","pihak.telepon","kabupaten.nama AS kabupaten","provinsi.nama AS provinsi")
        ->leftJoin("provinsi", "pihak.propinsi_id","=","provinsi.id")
        ->leftJoin("kabupaten", "pihak.kabupaten_id","=","kabupaten.id")
        ->first();

        $akta_cerai = DB::table("perkara_akta_cerai")
        ->where("perkara_id", $id_perkara)
        ->select("perkara_id","nomor_akta_cerai","tgl_akta_cerai","no_seri_akta_cerai")
        ->first();

        return view("perkara.detail", compact("pihak","akta_cerai"));
    }

    public function test_query(){

        $sql = DB::table("perkara")
        ->where("perkara.tahapan_terakhir_id", 19)
        ->select("perkara.perkara_id", "perkara_pihak2.nama AS nama_pihak2 AS id_pihak2", "perkara_pihak1.pihak_id AS id_pihak1", "perkara_pihak1.nama AS nama_pihak1", "perkara_pihak2.pihak_id", "perkara.tanggal_pendaftaran", "perkara.tahapan_terakhir_id", "perkara.jenis_perkara_text", "perkara.nomor_perkara", "perkara.tahapan_terakhir_text", "perkara_akta_cerai.nomor_akta_cerai", "perkara_akta_cerai.tgl_akta_cerai", "perkara_akta_cerai.no_seri_akta_cerai")
        ->leftJoin("perkara_akta_cerai", "perkara.perkara_id","=","perkara_akta_cerai.perkara_id")
        ->join("perkara_pihak1", "perkara.perkara_id","=","perkara_pihak1.perkara_id")
        ->join("perkara_pihak2","perkara.perkara_id", "=", "perkara_pihak2.perkara_id")
        ->get();

        $test = "abc";

        return view("test.index", compact("sql","test"));
    }

    public function pengajuan($id_perkara, $id_pihak){
        $pihak = DB::table("pihak")
        ->where("pihak.id", $id_pihak)
        ->select("id AS pihak_id","tempat_lahir","tanggal_lahir","jenis_kelamin","nomor_indentitas","nama","alamat","status_pengajuan","telepon")
        ->first();

        $akta_cerai = DB::table("perkara_akta_cerai")
        ->where("perkara_id", $id_perkara)
        ->select("perkara_id","nomor_akta_cerai","tgl_akta_cerai","no_seri_akta_cerai")
        ->first();

        return view("perkara.pengajuan.index", compact("pihak","akta_cerai"));
    }

    public function edit($id_perkara, $id_pihak){
        $kabupaten=DB::table("kabupaten")->select("id AS id_kabupaten","nama AS kabupaten")->get();
        $provinsi=DB::table("provinsi")->select("id AS id_provinsi","nama AS provinsi")->get();
        $pihak = DB::table("pihak")
        ->where("pihak.id", $id_pihak)
        ->select("id AS pihak_id","tempat_lahir","tanggal_lahir","jenis_kelamin","nomor_indentitas","nama","alamat","telepon","kabupaten_id","propinsi_id")
        ->first();

        $akta_cerai = DB::table("perkara_akta_cerai")
        ->where("perkara_id", $id_perkara)
        ->select("perkara_id","nomor_akta_cerai","tgl_akta_cerai","no_seri_akta_cerai")
        ->first();

        return view("perkara.pengajuan.edit", compact("pihak","akta_cerai","kabupaten","provinsi"));
    }

    public function update(Request $request, $id_perkara, $id_pihak){
        DB::table("pihak")
        ->where("id",$id_pihak)
        ->update(
            [
                "nama"=>$request->nama,
                "alamat"=>$request->alamat,
                "nomor_indentitas"=>$request->nik,
                "propinsi_id"=>$request->provinsi,
                "kabupaten_id"=>$request->kabupaten,
                "telepon"=>$request->telepon,
                "jenis_kelamin"=>$request->jenis_kelamin
            ],
        );
        
            return redirect("/perkara/$id_perkara/pengajuan/$id_pihak/detail");
        
    }

    public function kirim(Request $request, $id_perkara, $id_pihak){
        DB::table("pihak")
        ->where("id",$id_pihak)
        ->update([
            "status_pengajuan"=>$request->status
        ]);

        //return redirect("/perkara");
        return response()->json();
    }

    public function kirim_notifikasi(Request $request, $id_perkara, $id_pihak){
        DB::table("pihak")
        ->where("id",$id_pihak)
        ->update([
            "status_pengajuan"=>$request->status_pengajuan
        ]);

        //create new user
        $username="semar".$request->id_pihak;
        $password="semar".$request->id_pihak;
        DB::table("users")
        ->insertOrIgnore([
            "id"=>$request->id_pihak,
            "name"=>ucwords(strtolower($request->nama_pihak)),
            "username"=>strtolower($username),
            "password"=>Hash::make($password),
            "status"=>$request->status_user,
            "no_telp"=>$request->no_telp
        ]);

        return response()->json();

    }

    public function kirim_pengajuan(Request $request, $id_perkara, $id_pihak){
        DB::table("pihak")
        ->where("id",$id_pihak)
        ->update([
            "status_pengajuan"=>$request->status
        ]);

        return response()->json();
    }
}
