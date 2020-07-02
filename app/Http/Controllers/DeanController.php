<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dean;
use App\Document;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DeanController extends Controller
{
    public function index()
    {
        return view('dean/login');
    }

    public function show()
    {
        $deans =  Dean::all();
        return view('dean/show')->with('deans', $deans);
    }

    public function edit($id)
    {
        $dean = Dean::find($id);

        return view('dean/edit')->with('dean', $dean);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'staff_id' => 'required',
            'email' => 'required',

        ]);


        $dean =  Dean::find($id);

        $dean->staff_id = $request->input('dean_id');

        $dean->email = $request->input('email');

        $dean->save();

        return redirect('/dean/show')->with('success', 'Updated SuccessFul');
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

    public function dean_signup_page(){

        return view('dean/register');
    }

    public function dean_dashboard(){

        $documents =  Document::all();

        return view('dean/dashborad')->with('documents', $documents);
        // $deans =  Dean::all();
        // return view('dean/dashborad')->with('deans', $deans);
    }

    public function dean_register(Request $request){

        $this->validate($request,[
        'dean_id' => 'required',
        'email' => 'required',
        'password' => 'required',
        ]);

        $dean = new Dean();

        $dean->dean_id = $request->input('dean_id');

        $dean->email = $request->input('email');

        $dean->password =  Hash::make($request->input('password'));

        $dean->save();

        Auth::guard('dean')->login($dean);

        // Auth::login($auditor);

        return redirect("/auditor/dashboard")->with('success', 'Great! You have Successfully loggedin');

}

public function dean_login(Request $request){

    $this->validate($request, [
        'dean_id' => 'required',
        'password' => 'required',

    ]);

    if (Auth::guard('dean')->attempt([
        'dean_id' => $request->dean_id,
        'password' => $request->password])
    ){
        return redirect('/dean/dashboard');
    }
    return redirect('/dean/login')->with('error', 'dean id or Password');

}

public function logout(Request $request)
{

    Auth::guard('dean')->logout();

    $request->session()->flush();

    $request->session()->regenerate();

    return redirect('/dean/login');
}
}
