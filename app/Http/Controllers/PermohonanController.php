<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PermohonanController extends Controller
{
    public function index(){
        $perkara = DB::table("perkara")
        ->where("perkara.tahapan_terakhir_id",19)
        ->select('perkara.perkara_id', 'perkara.tanggal_pendaftaran','perkara.tahapan_terakhir_id', 'perkara.jenis_perkara_text', 'perkara.nomor_perkara', 'perkara.tahapan_terakhir_text',"perkara_akta_cerai.nomor_akta_cerai","perkara_akta_cerai.tgl_akta_cerai","no_seri_akta_cerai")
        ->join("perkara_akta_cerai","perkara.perkara_id","=","perkara_akta_cerai.perkara_id")
        //->groupBy("perkara.tahapan_terakhir_text","perkara.perkara_id","perkara.tanggal_pendaftaran","perkara.tahapan_terakhir_id",".perkara.jenis_perkara_text","perkara.nomor_perkara","perkara_akta_cerai.nomor_akta_cerai","perkara_akta_cerai.tgl_akta_cerai","perkara_akta_cerai.no_seri_akta_cerai")
        ->get();

        $pihak1 = DB::table("perkara_pihak1")
        ->select("perkara_pihak1.perkara_id","perkara_pihak1.pihak_id");

        $para_pihak = DB::table("perkara_pihak2")
        ->select("perkara_pihak2.perkara_id","perkara_pihak2.pihak_id")
        ->union($pihak1)
        ->get(); 

        $pihak_info = DB::table("pihak")
        ->whereNotNull("status_pengajuan")
        ->orderBy("id","DESC")
        ->get();

        $status_pengajuan = DB::table("status_pengajuan")
        ->get();

        return view('permohonan.index', compact("perkara", "para_pihak","pihak_info","status_pengajuan"));
    }

    public function pengajuan($id_perkara, $id_pihak){
        $pihak = DB::table("pihak")
        ->where("pihak.id", $id_pihak)
        ->select("id AS pihak_id","tempat_lahir","tanggal_lahir","jenis_kelamin","nomor_indentitas","nama","alamat","status_pengajuan")
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
