<?php

namespace App\Http\Controllers;

use App\Models\ContactInfo;
use Illuminate\Http\Request;

class ContactFormController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email'=>['required','email'],
            'name'=>['required','alpha:ascii'],
            'message'=>['required'],
            'link'=>['nullable','sometimes','url']    
        ]);
        
        $contact_info = new ContactInfo();
        $contact_info->email = $request->email;
        $contact_info->name = $request->name;
        $contact_info->message = $request->message;
        $contact_info->job_link = $request->link;

        $success = $contact_info->save();    
       
        return redirect()->route('index',['formSendSuccess'=>$success]);   
    }
}
