<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use App\Models\LandListing;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class LandListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = LandListing::with('agent');


        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('property_name', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%")
                    ->orWhere('status', 'like', "%{$search}%")
                    ->orWhereHas('agent', function ($agentQuery) use ($search) {
                        $agentQuery->where('name', 'like', "%{$search}%");
                    });
            });
        }

        $listings = $query->latest()->paginate(10);

        return view('admin.landlistings.index', compact('listings'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $agents = User::whereHas('role', function ($q) {
            $q->where('name', 'Agent');
        })->get();

        return view('admin.landlistings.create', compact('agents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'property_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'plot_size' => 'required|string|max:100',
            'selling_price' => 'required|numeric|min:0',
            'status' => 'required|in:available,sold,reserved',
            'sales_agent_id' => 'required|exists:users,id',
            'description' => 'nullable|string',
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:50243',
            'map_link' => 'nullable|url',
        ]);

        $photos = [];
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('land-listings', 'public');
                $photos[] = $path;
            }
        }

        $validated['photos'] = $photos;
        $validated['slug'] = Str::slug($validated['property_name']) . '-' . time();

        LandListing::create($validated);

        return redirect()->route('admin.landlistings.index')
            ->with('success', 'Land listing created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(LandListing $landlisting)
    {
        $landlisting->load('agent');
        return view('admin.landlistings.show', compact('landlisting'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LandListing $landlisting)
    {
       $agents = User::whereHas('role', function ($q) {
            $q->where('name', 'Agent');
        })->get();
        return view('admin.landlistings.edit', compact('landlisting', 'agents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LandListing $landlisting)
    {
        $validated = $request->validate([
            'property_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'plot_size' => 'required|string|max:100',
            'selling_price' => 'required|numeric|min:0',
            'status' => 'required|in:available,sold,reserved',
            'sales_agent_id' => 'required|exists:users,id',
            'description' => 'nullable|string',
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'map_link' => 'nullable|url',
        ]);

        $photos = $landlisting->photos ?? [];

        if ($request->hasFile('photos')) {
            // Delete old photos
            foreach ($photos as $photo) {
                Storage::delete('public/' . $photo);
            }

            // Upload new photos
            $photos = [];
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('land-listings', 'public');
                $photos[] = $path;
            }
        }

        $validated['photos'] = $photos;
        $validated['slug'] = Str::slug($validated['property_name']) . '-' . $landlisting->id;

        $landlisting->update($validated);

        return redirect()->route('admin.landlistings.index')
            ->with('success', 'Land listing updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LandListing $landlisting)
    {
        // Delete associated photos
        foreach ($landlisting->photos as $photo) {
            Storage::delete('public/' . $photo);
        }

        $landlisting->delete();

        return redirect()->route('admin.landlistings.index')
            ->with('success', 'Land listing deleted successfully.');
    }
}
