<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Registrar;
use App\Document;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegistrarController extends Controller
{
    public function index()
    {
        return view('registrar/login');
    }

    public function show()
    {
        $registrars =  Registrar::all();
        return view('registrar/show')->with('registrars', $registrars);
    }

    public function edit($id)
    {
        $registrar = Registrar::find($id);

        return view('registrar/edit')->with('registrar', $registrar);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'staff_id' => 'required',
            'email' => 'required',

        ]);

        $registrar =  Registrar::find($id);

        $registrar->staff_id = $request->input('registrar_id');

        $registrar->email = $request->input('email');

        $registrar->save();

        return redirect('/registrar/show')->with('success', 'Updated SuccessFul');
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

    public function registrar_signup_page(){

        return view('registrar/register');
    }

    public function registrar_dashboard(){

        // $registrars =  Registrar::all();
        $documents =  Document::all();

        return view('registrar/dashborad')->with('documents', $documents);
    }

    public function registrar_register(Request $request){

        $this->validate($request,[
        'registrar_id' => 'required',
        'email' => 'required',
        'password' => 'required',
        ]);

        $registrar = new Registrar();


        $registrar->registar_id = $request->input('registrar_id');

        $registrar->email = $request->input('email');

        $registrar->password =  Hash::make($request->input('password'));

        $registrar->save();

        Auth::guard('registrar')->login($registrar);

        // Auth::login($auditor);

        return redirect("/auditor/dashboard")->with('success', 'Great! You have Successfully loggedin');

}

public function registrar_login(Request $request){

    $this->validate($request, [
        'registrar_id' => 'required',
        'password' => 'required',

    ]);

    if (Auth::guard('registrar')->attempt([
        'registrar_id' => $request->registrar_id,
        'password' => $request->password])
    ){
        return redirect('/registrar/dashboard');
    }
    return redirect('/registrar/login')->with('error', 'registrar id or Password');

}

public function logout(Request $request)
{

    Auth::guard('registrar')->logout();

    $request->session()->flush();

    $request->session()->regenerate();

    return redirect('/registrar/login');
}
}
