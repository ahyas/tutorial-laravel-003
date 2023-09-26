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
            ->select("users.id AS id_user","users.name","users.status AS id_status","roles.role","status.status","users.email","users.no_telp")
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
        ->select("users.id AS id_user","users.name","users.username","roles.role","roles.id AS id_role","status.status","users.email","users.no_telp")
        ->leftjoin("roles", "users.role_id","=","roles.id")
        ->leftjoin("status","users.status","=","status.id")
        ->first();

        return view("users.detail.index", compact("table"));
    }

    public function edit($id_user){
        $table= DB::table("users")
        ->where("users.id",$id_user)
        ->select("users.id AS id_user","users.name","roles.id AS id_role","status.id AS id_status","users.email","users.no_telp")
        ->leftjoin("roles", "users.role_id","=","roles.id")
        ->leftjoin("status","users.status","=","status.id")
        ->first();

        $status = DB::table("status")->get();

        $roles = DB::table("roles")
        ->where("id","!=", 0)
        ->get();

        return view("users.edit", compact("table", "status","roles"));
    }

    public function update(Request $request, $id_user){
        
        DB::table("users")
        ->where("id", $id_user)
        ->update([
            "users.name" => $request["nama"],
            "users.email"=>$request["email"],
            "users.no_telp"=>$request["no_telp"],
            "users.status"=>$request["status"],
            "users.role_id"=>$request["role"]
        ]);
        
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

        DB::table("users")
        ->where("id", $id_user)
        ->update([
            "password"=>Hash::make($request->confirm_new_pass),
        ]);

        Session::flash('success', 'Reset Username/password berhasil');
        return redirect()->route("users.detail", ['id_user'=>$id_user]);
    }
}
