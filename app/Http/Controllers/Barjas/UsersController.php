<?php

namespace App\Http\Controllers\Barjas;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index(){
        return view("/pages/barjas-users/users-list");
    }

    public function get_all_users(){ 
        $users = User::all();
        return array("data" => $users);
    }

    public function ambil($id){
        return User::whereId($id)->get();
    }

    public function buat(Request $request){
        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);
        return back()->with("status", "Akun $request->name berhasil di buat");
    }

    public function ubah(Request $request, $id){
        $name = $request->name;
        User::whereId($id)->update([
            "password" => Hash::make($request->password)
        ]);
        return back()->with("status", "Password akun $name berhasil di update");
    }

    public function hapus($id) {
        User::where('id', $id)->delete();
        return response()->json([
            'success' => 'Berhasil menghapus data pengguna!'
        ]);
    }
}
