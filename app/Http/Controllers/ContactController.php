<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contact = Contact::all();
        return view('admin.contact.index', compact('contact'));
    }


    public function create(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:contacts',
            'phone' => 'required',
            'address' => 'required',
            'google_map' => "nullable",
            'facebook' => 'nullable',
            'instagram' => 'nullable',
            'linkedin' => 'nullable',
            'twitter' => 'nullable',
            'youtube' => 'nullable',
        ]);

        $contact = new Contact();
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->address = $request->address;
        $contact->google_map = $request->google_map;
        $contact->facebook = $request->facebook;
        $contact->instagram = $request->instagram;
        $contact->linkedin = $request->linkedin;
        $contact->twitter = $request->twitter;
        $contact->youtube = $request->youtube;

        $contact->save();

        return response()->json([
           'status' => 'success',
        ]);
    }
}
