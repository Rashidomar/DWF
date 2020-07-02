<?php

namespace App\Http\Controllers;

use App\Document;
use App\Inbox_Audit;
use App\Staff;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class DocumentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin,staff,auditor,registrar,dean');
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documents =  Document::all();
        return view('staff/staffdashborad')->with('documents', $documents);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('document/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'description'=>'required',
            'document_name' => 'required|image|max:1999'
        ]);
        // Handle File Upload
        if($request->hasFile('document_name')) {
            // Get filename with extension
            $filenameWithExt = $request->file('document_name')->getClientOriginalName();
            // Get just ext
            $extension = $request->file('document_name')->getClientOriginalExtension();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
        }

        // create Post
        $document = new Document();
        $document->description = $request->input('description');
        $document->staff_id = Auth::guard('staff')->id();
        $document->name = $fileNameToStore;
        if($document->save()){

            $lastInsertedId = $document->id;
          // Upload Image
             $path = $request->file('document_name')->storeAs('public/cover_images', $fileNameToStore);

            //getting staff_id
            $id = Auth::guard('staff')->id();
            $staff_id = Staff::find($id)->staff_id;

            //create an inbox message for the auditor
            $message = "New Document uploaded";
            $inbox_audit = new Inbox_Audit();
            $inbox_audit->staff_id = $staff_id;
            $inbox_audit->message = $message;
            $inbox_audit->document_id = $lastInsertedId;
            $inbox_audit->document_name = $fileNameToStore;
            $inbox_audit->save();

             }
        return redirect('/document')->with('success', 'Upload Successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $document = Document::find($id);

        return view('document/show')->with('document', $document);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
