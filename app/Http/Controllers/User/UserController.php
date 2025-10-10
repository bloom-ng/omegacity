<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\ContactMessage;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function HomePage()
    {
        return view("users.home");
    }


    public function ContactUsStore(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:2000',
        ]);

        ContactMessage::create($validated);

        return back()->with('success', 'Message sent successfully!');
    }

    public function ContactUsPage()
    {
        return view("users.contact-us");
    }
}
