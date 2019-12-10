<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
    public function index(){
        auth()->guard('admin')->logout();
        return redirect()->route('admin.auth.login');
    }
}
