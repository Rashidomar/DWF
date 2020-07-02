<?php

namespace App\Http\Controllers;


use App\Document;
use App\Admin;
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

        $documents =  Document::all();
        return view('admin/admindashborad')->with('documents', $documents);
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


        return redirect("/admin/admindashboard")->with('success', 'Great! You have Successfully loggedin');

}

public function admin_login(Request $request){

    $this->validate($request, [
        'username' => 'required',
        'password' => 'required',

    ]);
    if (Auth::guard('admin')->attempt([
        'username' => $request->username,
        'password' => $request->password])
    ){
        return redirect('/admin/admindashboard');
    }
    return redirect('/admin/login')->with('error', 'username or Password');

}

public function logout(Request $request)
{

    Auth::guard('admin')->logout();

    $request->session()->flush();

    $request->session()->regenerate();

    return redirect('/admin/login');
}

}
