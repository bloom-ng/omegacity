<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    /**
     * Display a listing of the clients.
     */
    public function index()
    {
        $clients = Client::latest()->paginate(10);
        return view('admin.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new client.
     */
    public function create()
    {
        return view('admin.clients.create');
    }

    /**
     * Store a newly created client in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'source' => 'nullable|string|max:255',
            'budget_range' => 'nullable|string|max:255',
            'interested_land_id' => 'nullable|exists:land_listings,id',
            'follow_up_date' => 'nullable|date',
            'remark' => 'nullable|string',
            'status' => 'nullable|string|max:255',
            'assigned_agent_id' => 'nullable|exists:users,id',
        ]);

        $client = Client::create($validated);

        // If created by agent (not admin), auto-assign to themselves
        if (auth()->user()->isAgent() && !$request->filled('assigned_agent_id')) {
            $client->update(['assigned_agent_id' => auth()->id()]);
        }

        return redirect()->route('admin.clients.index')
            ->with('success', 'Client created successfully.');
    }

    /**
     * Display the specified client.
     */
    public function show(Client $client)
    {
        return view('admin.clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified client.
     */
    public function edit(Client $client)
    {
        return view('admin.clients.edit', compact('client'));
    }

    /**
     * Update the specified client in storage.
     */
    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'source' => 'nullable|string|max:255',
            'budget_range' => 'nullable|string|max:255',
            'interested_land_id' => 'nullable|exists:land_listings,id',
            'follow_up_date' => 'nullable|date',
            'remark' => 'nullable|string',
            'status' => 'nullable|string|max:255',
            'assigned_agent_id' => 'nullable|exists:users,id',
        ]);

        $client->update($validated);

        return redirect()->route('admin.clients.index')
            ->with('success', 'Client updated successfully');
    }

    /**
     * Remove the specified client from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('admin.clients.index')
            ->with('success', 'Client deleted successfully');
    }
}
