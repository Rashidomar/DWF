<?php

namespace App\Http\Controllers;

use App\admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function admin_login_page(){

        return view('admin/adminlogin');

    }

    public function admin_signup_page(){

        return view('admin/registeradmin');
    }

    public function admin_dashboard(){

        return view('admin/admindashborad');
    }

    public function admin_register(Request $request){

        $this->validate($request,[
        'username' => 'required',
        'email' => 'required',
        'password' => 'required',
        ]);

        $admin = new admin();


        $admin->username = $request->input('username');

        $admin->email = $request->input('email');

        $admin->password =  Hash::make($request->input('password'));

        $admin->save();

        Auth::login($admin);


        return redirect("/admin/admindashborad")->with('success', 'Great! You have Successfully loggedin');

}

public function admin_login(Request $request){

    $this->validate($request, [
        'username' => 'required',
        'password' => 'required',

    ]);

    if (Auth::attempt([
        'username' => $request->username,
        'password' => $request->password])
    ){
        return redirect('/admin/admindashboard');
    }
    return redirect('/admin/adminlogin')->with('error', 'username or Password');

}

public function logout() {

    Auth::logout();

    return redirect('/admin/adminlogin');
}

}
