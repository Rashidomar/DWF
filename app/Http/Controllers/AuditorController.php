<?php

namespace App\Http\Controllers;

use App\Auditor;
use App\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuditorController extends Controller
{
    public function index()
    {
        return view('auditor/login');
    }

    public function show()
    {
        $auditors =  auditor::all();
        return view('auditor/show')->with('auditors', $auditors);
    }

    public function edit($id)
    {
        $auditor = auditor::find($id);

        return view('auditor/edit')->with('auditor', $auditor);
    }



    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'auditor_id' => 'required',
            'email' => 'required',

        ]);

        $auditor =  auditor::find($id);

        $auditor->staff_id = $request->input('auditor_id');

        $auditor->email = $request->input('email');

        $auditor->save();

        return redirect('/auditor/show')->with('success', 'Updated SuccessFul');
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

    public function auditor_signup_page(){

        return view('auditor/register');
    }

    public function auditor_dashboard(){

        $documents =  Document::all();
        return view('auditor/dashborad')->with('documents', $documents);
    }

    public function auditor_register(Request $request){

        $this->validate($request,[
        'auditor_id' => 'required',
        'email' => 'required',
        'password' => 'required',
        ]);

        $auditor = new auditor();


        $auditor->auditor_id = $request->input('auditor_id');

        $auditor->email = $request->input('email');

        $auditor->password =  Hash::make($request->input('password'));

        $auditor->save();

        Auth::guard('auditor')->login($auditor);

        // Auth::login($auditor);

        return redirect("/auditor/dashboard")->with('success', 'Great! You have Successfully loggedin');

}

public function auditor_login(Request $request){

    $this->validate($request, [
        'auditor_id' => 'required',
        'password' => 'required',

    ]);

    if (Auth::guard('auditor')->attempt([
        'auditor_id' => $request->auditor_id,
        'password' => $request->password])
    ){
        return redirect('/auditor/dashboard');
    }
    return redirect('/auditor/login')->with('error', 'auditor id or Password');

}

public function logout(Request $request)
{

    Auth::guard('auditor')->logout();

    $request->session()->flush();

    $request->session()->regenerate();

    return redirect('/auditor/login');
}

}
