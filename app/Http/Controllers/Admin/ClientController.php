<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use App\Models\LandListing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    /**
     * Display a listing of the clients.
     */
    public function index(Request $request)
{
    $query = Client::with('interestedLand');

    if ($request->filled('search')) {
        $search = $request->input('search');

        $query->where(function ($q) use ($search) {
            $q->where('first_name', 'like', "%{$search}%")
              ->orWhere('last_name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%")
              ->orWhere('phone', 'like', "%{$search}%")
              ->orWhere('address', 'like', "%{$search}%");
        });
    }

    $clients = $query->latest()->paginate(10)->withQueryString();

    return view('admin.clients.index', compact('clients'));
}


    /**
     * Show the form for creating a new client.
     */
    public function create()
    {
        $land_listings = LandListing::all();
        return view('admin.clients.create', compact('land_listings'));
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
        $land_listings = LandListing::all();
        return view('admin.clients.edit', compact('client', 'land_listings'));
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
            ->with('success', 'Client updated successfully.');
    }

    /**
     * Remove the specified client from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()->route('admin.clients.index')
            ->with('success', 'Client deleted successfully.');
    }
}
