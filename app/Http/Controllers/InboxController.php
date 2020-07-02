<?php

namespace App\Http\Controllers;

use App\Inbox_Audit;
use App\Inbox_Dean;
use App\Inbox_Registrar;
use App\Document;
use App\Message_Approved;
use App\Message_Disapproved;

use Illuminate\Http\Request;

class InboxController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin,staff,auditor,registrar,dean');
        //
    }
    public function inbox_audit(){
        // $inbox = new Inbox_Audit();
        $inboxs = Inbox_Audit::all();
        return view('inbox/inbox_audit')->with('inboxs', $inboxs);
    }

    //putting message into the inbox registrar
    public function inbox_registrar($id, $auditor_id, $staff_id){
        $document_name = Document::find($id)->name;
        $message = "Document has been approved";
        $inbox_registrar = new Inbox_Registrar();
        $inbox_registrar->auditor_id = $auditor_id;
        $inbox_registrar->staff_id = $staff_id;
        $inbox_registrar->message = $message;
        $inbox_registrar->document_id = $id;
        $inbox_registrar->document_name = $document_name;
        $inbox_registrar->save();
        return redirect('/auditor/dashboard');
    }

    public function get_inbox_registrar(){

        $inboxs = Inbox_Registrar::all();
        return view('inbox/inbox_registrar')->with('inboxs', $inboxs);
    }
        //{document_id}/{staff_id}/{auditor_id}/{reg_id}
        //putting message into the inbox registrar
        public function inbox_dean($id, $staff_id, $registrar_id){
            $document_name = Document::find($id)->name;
            $message = "Document has been approved";
            $inbox_dean = new Inbox_Dean();
            $inbox_dean->staff_id = $staff_id;
            $inbox_dean->registrar_id = $registrar_id;
            $inbox_dean->message = $message;
            $inbox_dean->document_id = $id;
            $inbox_dean->document_name = $document_name;
            $inbox_dean->save();
            return redirect('/registrar/dashboard');
        }

        public function get_inbox_dean(){

            $inboxs = Inbox_Dean::all();

            return view('inbox/inbox_dean')->with('inboxs', $inboxs);
        }

        public function approved($id, $staff_id){

            $info = "Document approved by dean";

            $message = new Message_Approved();
            $message->message = $info;
            $message->document_id = $id;
            $message->staff_id = $staff_id;
            $message->save();
            return redirect('/dean/dashboard');
        }

        public function disapproved($id, $staff_id){

            $info = "Document disapproved by dean";

            $message = new Message_Approved();
            $message->message = $info;
            $message->document_id = $id;
            $message->staff_id = $staff_id;
            $message->save();
            return redirect('/dean/dashboard');
        }

        public function get_approved(){

            $approves = Message_Approved::all();

            return view('inbox/approved')->with('approves', $approves);
        }

        public function get_disapproved(){

            $approves = Message_Disapproved::all();

            return view('inbox/disapproved')->with('approves', $approves);
        }




}
