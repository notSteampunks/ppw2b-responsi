<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }
    
    public function index()
    {
        $data_user   = User::all();
        $banyak_user = User::count();
        return view('user.user', compact('data_user','banyak_user'));
    }
    public function edit($id)
    {
        $data_user = User::find($id);
        return view('user.edituser', compact('data_user'));
    }
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'          => 'required|string',
            'email'         => 'required|string',
            'level'         => 'required|string',
        ]);
        $data_user               = User::find($id);
        $data_user->name         = $request->name;
        $data_user->email        = $request->email;
        $data_user->level        = $request->level;

        $data_user->update();
        return redirect('/user')->with('success_updated','Data User Berhasil Diupdate');
    }
}
