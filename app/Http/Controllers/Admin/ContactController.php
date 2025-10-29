<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');

    $contacts = ContactMessage::when($search, function ($query, $search) {
            $query->where('email', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
        })
        ->latest()
        ->paginate(10)
        ->appends(['search' => $search]);

    return view('admin.contacts.index', compact('contacts', 'search'));
}


 /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.contacts.create');
    }


    /**
     * Store a newly created client in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email'              => 'required|email|max:255',
            'remark'             => 'nullable|string',
        ]);

        ContactMessage::create($validated);

        return redirect()->route('admin.contacts.index')
            ->with('success', 'Contact created successfully.');
    }


     /**
     * Display the specified client.
     */
    public function show(ContactMessage $contact)
    {
        return view('admin.contacts.show', compact('contact'));
    }


     /**
     * Remove the specified client from storage.
     */
    public function destroy(ContactMessage $contact)
    {
        $contact->delete();

        return redirect()->route('admin.contacts.index')
            ->with('success', 'Contact deleted successfully.');
    }
}
