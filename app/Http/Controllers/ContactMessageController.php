<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;

class ContactMessageController extends Controller
{
     public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        ContactMessage::create($request->all());

        return back()->with('success', 'Your message has been sent successfully!');
    }

      public function index()
        {
            $messages = ContactMessage::latest()->paginate(10); // fetch all messages ordered by latest
            return view('admin.contact.index', compact('messages'));
        }
}
