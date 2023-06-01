<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

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
        $perkara = DB::table("perkara")
        ->select('perkara.perkara_id', 'perkara.tanggal_pendaftaran','perkara.tahapan_terakhir_id', 'perkara.jenis_perkara_text', 'perkara.nomor_perkara', 'perkara.tahapan_terakhir_text',"perkara_pihak1.nama AS pihak_1","perkara_pihak2.nama AS pihak_2","perkara_akta_cerai.nomor_akta_cerai","perkara_akta_cerai.tgl_akta_cerai","no_seri_akta_cerai")
        ->leftJoin("perkara_pihak1", "perkara.perkara_id","=","perkara_pihak1.perkara_id")
        ->leftJoin("perkara_pihak2", "perkara.perkara_id","=","perkara_pihak2.perkara_id")
        ->leftJoin("perkara_akta_cerai","perkara.perkara_id","=","perkara_akta_cerai.perkara_id")
        ->orderBy("perkara.perkara_id","DESC")
        ->get();

        $pihak1 = DB::table("perkara_pihak1")
        ->select("perkara_pihak1.perkara_id","perkara_pihak1.pihak_id","perkara_pihak1.nama","perkara_pihak1.alamat");

        $para_pihak = DB::table("perkara_pihak2")
        ->select("perkara_pihak2.perkara_id","perkara_pihak2.pihak_id","perkara_pihak2.nama","perkara_pihak2.alamat")
        ->union($pihak1)
        ->get(); 

        $pihak_info = DB::table("pihak")
        ->orderBy("id","DESC")
        ->get();

        return view('perkara.index', compact("perkara", "para_pihak","pihak_info"));
    }

    public function pengajuan($id_pihak){
        $pihak1 = DB::table("perkara_pihak1 AS H")
        ->where("H.pihak_id",$id_pihak)
        ->join("pihak AS B", "H.pihak_id","=","B.id")
        ->select("B.tempat_lahir","B.tanggal_lahir","B.jenis_kelamin","B.nomor_indentitas","H.perkara_id","H.pihak_id","H.nama","H.alamat");

        $pihak = DB::table("perkara_pihak2 AS H")
        ->where("H.pihak_id",$id_pihak)
        ->join("pihak AS B","H.pihak_id","=","B.id")
        ->select("B.tempat_lahir","B.tanggal_lahir","B.jenis_kelamin","B.nomor_indentitas","H.perkara_id","H.pihak_id","H.nama","H.alamat")
        ->union($pihak1)
        ->first();

        return view("perkara.pengajuan.index", compact("pihak"));
    }
}
