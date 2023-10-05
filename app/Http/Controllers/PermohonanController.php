<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class PermohonanController extends Controller
{
    public function index(){
        $sql = DB::table("perkara")
        ->where("perkara.tahapan_terakhir_id", 19)
        ->whereNotNull("perkara_pihak1.nama")
        ->Where("c.status_pengajuan",1)//Bila user sudah melakukan pengajuan
        ->orWhere("d.status_pengajuan",1)
        ->orWhere("c.status_pengajuan",2)
        ->orWhere("d.status_pengajuan",2)
        ->orWhere("c.status_pengajuan",3)
        ->orWhere("d.status_pengajuan",3)
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
            "c.satker_induk AS satker_induk1", 
            "d.satker_induk AS satker_induk2",
            "c.satker_anak AS satker_anak1", 
            "d.satker_anak AS satker_anak2",
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
        )
        ->leftjoin("perkara_akta_cerai", "perkara.perkara_id","=","perkara_akta_cerai.perkara_id")
        ->leftjoin("perkara_pihak1", "perkara.perkara_id","=","perkara_pihak1.perkara_id")
        ->leftjoin("perkara_pihak2","perkara.perkara_id", "=", "perkara_pihak2.perkara_id")
        ->leftjoin("pihak AS c", "perkara_pihak1.pihak_id", "=", "c.id")
        ->leftjoin("pihak AS d", "perkara_pihak2.pihak_id", "=", "d.id")
        ->leftJoin("status_pengajuan AS a", "c.status_pengajuan", "=", "a.id")
        ->leftJoin("status_pengajuan AS b", "d.status_pengajuan", "=", "b.id")
        ->leftJoin("jenis_kelamin AS e", "c.jenis_kelamin", "=" ,"e.kode")
        ->leftJoin("jenis_kelamin AS f", "d.jenis_kelamin", "=" ,"f.kode")
        ->paginate(10);

        $baris = $sql->count();

        return view('permohonan.index', compact("sql","baris"));
    }

    public function pengajuan($id_perkara, $id_pihak){
        $pihak = DB::table("pihak")
        ->where("pihak.id", $id_pihak)
        ->select("pihak.id AS pihak_id","pihak.tempat_lahir","pihak.tanggal_lahir","pihak.jenis_kelamin","pihak.nomor_indentitas","pihak.nama","pihak.alamat","pihak.status_pengajuan","pihak.telepon AS no_telp", "kabupaten.nama AS kabupaten","provinsi.nama AS provinsi")
        ->leftJoin("provinsi", "pihak.propinsi_id","=","provinsi.id")
        ->leftJoin("kabupaten", "pihak.kabupaten_id","=","kabupaten.id")
        ->first();

        $akta_cerai = DB::table("perkara_akta_cerai")
        ->where("perkara_id", $id_perkara)
        ->select("perkara_id","nomor_akta_cerai","tgl_akta_cerai","no_seri_akta_cerai")
        ->first();

        return view("permohonan.pengajuan.index", compact("pihak","akta_cerai"));
    }

    public function proses(Request $request, $id_perkara, $id_pihak){
        DB::table("pihak")
        ->where("id",$id_pihak)
        ->update([
            "status_pengajuan"=>$request->status
        ]);

        return response()->json();
    }

    public function selesai(Request $request, $id_perkara, $id_pihak){
        DB::table("pihak")
        ->where("id",$id_pihak)
        ->update([
            "status_pengajuan"=>$request->status
        ]);

        return response()->json();
    }
}
