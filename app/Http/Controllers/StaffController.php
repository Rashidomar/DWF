<?php

namespace App\Http\Controllers;

use App\Staff;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{

    public function staff_login_page(){

        return view('staff/stafflogin');

    }

    public function staff_signup_page(){

        return view('staff/registerstaff');
    }

    public function staff_dashboard(){

        return view('staff/staffdashborad');
    }

    public function staff_register(Request $request){

        $this->validate($request,[
        'staff_id' => 'required',
        'email' => 'required',
        'password' => 'required',
        ]);

        $staff = new Staff();


        $staff->staff_id = $request->input('staff_id');

        $staff->email = $request->input('email');

        $staff->password =  Hash::make($request->input('password'));

        $staff->save();

        Auth::login($staff);


        return redirect("/staff/staffdashborad")->with('success', 'Great! You have Successfully loggedin');

}

public function staff_login(Request $request){

    $this->validate($request, [
        'staff_id' => 'required',
        'password' => 'required',

    ]);

    if (Auth::attempt([
        'staff_id' => $request->staff_id,
        'password' => $request->password])
    ){
        return redirect('/staff/staffdashboard');
    }
    return redirect('/staff/stafflogin')->with('error', 'staff id or Password');

}

public function logout() {

    Auth::logout();

    return redirect('/staff/stafflogin');
}

}
