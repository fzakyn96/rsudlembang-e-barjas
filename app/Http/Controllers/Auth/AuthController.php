<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    } 

    public function create(Request $request){
        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);
        return redirect("/pages/barjas-users/users-list");
    }

    public function update(Request $request, $id){
        $name = $request->name;
        User::whereId($id)->update([
            "password" => Hash::make($request->password)
        ]);
        return back()->with("status", "Password akun $name berhasil di update");
    }

    public function delete($id) {
        User::find($id)->delete();
        return back()->with("status", "Berhasil delete data");
    }
}
