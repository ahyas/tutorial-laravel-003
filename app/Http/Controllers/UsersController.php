<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use DB;
use Auth;
use Session;
use Hash;

class UsersController extends Controller
{
    public function index(){
        if (Auth::user()->role_id == 0){
            $table= DB::table("users")
            ->whereNotIn("roles.id", [0])
            ->select("users.id AS id_user","users.name","users.status AS id_status","roles.role","roles.id AS id_role","status.status","users.email","users.no_telp")
            ->leftJoin("roles", "users.role_id","=","roles.id")
            ->leftJoin("status","users.status","=","status.id")
            ->get();

            return view("users.index", compact("table"));
        }else{
            return redirect("/home");
        }
        
    }

    public function detail($id_user){
        $table= DB::table("users")
        ->where("users.id",$id_user)
        ->select("users.id AS id_user","users.name","satker_anak.nama AS satker_anak","satker_induk.nama AS satker_induk","users.username","roles.role","roles.id AS id_role","status.status","status.id AS id_status","users.email","users.no_telp")
        ->leftjoin("roles", "users.role_id","=","roles.id")
        ->leftjoin("status","users.status","=","status.id")
        ->leftjoin("satker_induk", "users.satker_induk","=","satker_induk.id")
        ->leftJoin("satker_anak","users.satker_anak","=","satker_anak.id")
        ->first();

        return view("users.detail.index", compact("table"));
    }

    public function edit($id_user){
        $table= DB::table("users")
        ->where("users.id",$id_user)
        ->select("users.id AS id_user","users.name","users.satker_induk","users.satker_anak","roles.id AS id_role","status.id AS id_status","users.email","users.no_telp")
        ->leftjoin("roles", "users.role_id","=","roles.id")
        ->leftjoin("status","users.status","=","status.id")
        ->first();

        $status = DB::table("status")->get();

        $roles = DB::table("roles")
        ->where("id","!=", 0)
        ->get();

        if($table->id_role == 1 || $table->id_role == 2){
            $satker_induk=DB::table("satker_induk")->where("category",1)->select("id","nama AS satker_induk")->get();
            $satker_anak=DB::table("satker_anak")->where("id_induk",1)->select("id","id_induk", "nama AS satker_anak")->get();
        }else{
            $satker_induk=DB::table("satker_induk")->where("category",2)->select("id","nama AS satker_induk")->get();
            $satker_anak=DB::table("satker_anak")->where("id_induk",2)->select("id","id_induk", "nama AS satker_anak")->get();
        }

        return view("users.edit", compact("table", "status","roles","satker_induk","satker_anak"));
    }

    public function update(Request $request, $id_user){
        if(Auth::user()->role_id == 0){
            $data = [
                "name" => $request["name"],
                "email"=>$request["email"],
                "no_telp"=>$request["no_telp"],
                "status"=>$request["status"],
                "role_id"=>$request["role_id"],
                "satker_induk"=>$request["satker_induk"],
                "satker_anak"=>$request["satker_anak"]
            ];
        }else{
            $data = [
                "name" => $request["name"],
                "email"=>$request["email"],
                "no_telp"=>$request["no_telp"]
            ];
        }
        
        DB::table("users")
        ->where("id", $id_user)
        ->update($data);
        
        Session::flash('success', 'Data berhasil di perbaharui');
        return redirect()->route("users.detail", ['id_user'=>$id_user]);
    }

    public function delete($id_user){
        
        DB::table("users")
        ->where("id", $id_user)
        ->delete();

        Session::flash('success', 'Data berhasil dihapus');
        return redirect()->route("users.index");
    }

    public function reset($id_user){
        $table= DB::table("users")
        ->where("id",$id_user)
        ->select("id AS id_user","username")
        ->first();

        return view("users.reset", compact("table"));
    }

    public function update_password(Request $request, $id_user){

        if(Auth::user()->role_id == 0){
            $request->validate([
                'new_pass'=>'required',
                'confirm_new_pass'=>'required|same:new_pass'
            ],[
                'new_pass.required'=>'Password baru tidak boleh kosong',
                'confirm_new_pass.required'=>'Password baru tidak boleh kosong',
                'confirm_new_pass.same'=>'Konfirmsi password baru harus sama',
            ]);
        }else{
            $request->validate([
                'current_pass'=>['required', new MatchOldPassword],
                'new_pass'=>'required',
                'confirm_new_pass'=>'required|same:new_pass'
            ],[
                'current_pass.required'=>'Password saat ini tidak boleh kosong',
                'current_pass.confirmed'=>'Password lama salah',
                'new_pass.required'=>'Password baru tidak boleh kosong',
                'confirm_new_pass.required'=>'Password baru tidak boleh kosong',
                'confirm_new_pass.same'=>'Konfirmsi password baru harus sama',
            ]);
        }

        DB::table("users")
        ->where("id", $id_user)
        ->update([
            "password"=>Hash::make($request->confirm_new_pass),
        ]);

        Session::flash('success', 'Reset Username/password berhasil');
        return redirect()->route("users.detail", ['id_user'=>$id_user]);
    }
}
