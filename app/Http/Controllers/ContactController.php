<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
class ContactController extends Controller
{
    public function AdminContact(){
        $contacts = Contact::all();
        return view('admin.contact.index',compact('contacts'));
    }

    public function AddContact(){
        return View('admin.contact.create');
    }

    public function CreateContact(Request $request){
        $contactInfo = new Contact;
        $contactInfo->email = $request->email;
        $contactInfo->address = $request->address;
        $contactInfo->phone = $request->phone;
        $contactInfo->save();

        return Redirect()->route('admin.contact')->with('success','Contact info inserted successfully');
    }

    public function EditContact($id){
        $contact = Contact::find($id);
        return view('admin.contact.edit',compact('contact'));
    }

    public function UpdateContact($id, Request $request){
      $contactUp = Contact::find($id);
      $contactUp->email = $request->email;
      $contactUp->address = $request->address;
      $contactUp->phone = $request->phone;
      $contactUp->save();


        return Redirect()->route('admin.contact')->with('success','Contact info Updated successfully');
    }

    public function DeleteContact($id)
    {
      Contact::find($id)->delete();
        return Redirect()->route('admin.contact')->with('success','Contact info deleted successfully');
    }



}
