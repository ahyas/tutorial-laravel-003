<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SatkerController extends Controller
{
    public function satker_anak($id_induk){
        $table = DB::table("satker_anak")->where("id_induk",$id_induk)->get();
        return response()->json($table);
    }

    public function satker_induk($id_role){
        if($id_role == 1 || $id_role == 2){
            $satker_induk=DB::table("satker_induk")->where("category",1)->select("id","nama AS satker_induk")->get();
        }else{
            $satker_induk=DB::table("satker_induk")->where("category",2)->select("id","nama AS satker_induk")->get();
        }

        return response()->json($satker_induk);
    }
}
