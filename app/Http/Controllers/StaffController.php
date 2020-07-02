<?php

namespace App\Http\Controllers;

use App\Staff;
use App\Document;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('guest', ['except' => ['index','admin_login_page']]);
    // }

    public function index()
    {
        return view('staff/stafflogin');
    }

    public function show()
    {
        $staffs =  Staff::all();
        return view('staff/staffshow')->with('staffs', $staffs);
    }

    public function edit($id)
    {
        $staff = Staff::find($id);

        return view('staff/staffedit')->with('staff', $staff);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'staff_id' => 'required',
            'email' => 'required',

        ]);

        $staff =  Staff::find($id);

        $staff->staff_id = $request->input('staff_id');

        $staff->email = $request->input('email');

        $staff->save();

        return redirect('/staff/showstaff')->with('success', 'Updated SuccessFul');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function staff_signup_page(){

        return view('staff/registerstaff');
    }

    public function staff_dashboard(){

        $documents =  Document::all();
        return view('staff/staffdashborad')->with('documents', $documents);
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

        return redirect("/staff/staffdashboard")->with('success', 'Great! You have Successfully loggedin');

}

public function staff_login(Request $request){

    $this->validate($request, [
        'staff_id' => 'required',
        'password' => 'required',

    ]);

    if (Auth::guard('staff')->attempt([
        'staff_id' => $request->staff_id,
        'password' => $request->password])
    ){
        return redirect('/staff/staffdashboard');
    }
    return redirect('/staff/login')->with('error', 'staff id or Password');

}

// public function logout() {

//     Auth::logout();

//     return redirect('/staff/login');
// }

public function logout(Request $request)
{

    Auth::guard('staff')->logout();

    $request->session()->flush();

    $request->session()->regenerate();

    return redirect('/staff/login');
}

}
