<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class TestController extends Controller
{
    public function index(){
        $table = DB::table("dbsemar.users")->get();
        $table_sipp = DB::connection("mysql2")
        ->table("sipp_manokwari.agama")
        ->get();
        return view("test/index", compact("table","table_sipp"));
    }
}
