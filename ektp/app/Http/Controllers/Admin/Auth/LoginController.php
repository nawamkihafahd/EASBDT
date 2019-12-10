<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class LoginController extends Controller
{
    public function index(){
        return view('admin.auth.login');
    }

    public function store(Request $request){
        $this->validate($request,[
            'username' => 'required',
            'password' => 'required|min:8'
        ]);

        $credentials = [
            'username' => $request->username,
            'password' => $request->password
        ];
        $remember = $request->remember;

        if(auth()->guard('admin')->attempt($credentials,$remember)){
            return redirect()->intended(route('admin.index'));
        }

        return redirect()->back()->withInput($request->only('username','remember'));
    }
}
