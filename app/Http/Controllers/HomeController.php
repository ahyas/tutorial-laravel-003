<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
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
    public function index()
    {
        $perkara = DB::table("perkara")
        ->select('perkara.perkara_id', 'perkara.tanggal_pendaftaran', 'perkara.jenis_perkara_text', 'perkara.nomor_perkara', 'perkara.tahapan_terakhir_text',"perkara_pihak1.nama AS pihak_1","perkara_pihak2.nama AS pihak_2")
        ->Join("perkara_pihak1", "perkara.perkara_id","=","perkara_pihak1.perkara_id")
        ->Join("perkara_pihak2", "perkara.perkara_id","=","perkara_pihak2.perkara_id")
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

        return view('home', compact("perkara", "para_pihak","pihak_info"));
    }
}
