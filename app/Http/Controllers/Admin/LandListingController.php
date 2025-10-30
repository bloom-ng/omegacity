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
            'map_link' => 'nullable|string',
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
        
        // Process map link to extract embed URL if needed
        if (!empty($validated['map_link'])) {
            $validated['map_link'] = $this->processMapLink($validated['map_link']);
        }

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
            'map_link' => 'nullable|string',
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
        
        // Process map link to extract embed URL if needed
        if (!empty($validated['map_link'])) {
            $validated['map_link'] = $this->processMapLink($validated['map_link']);
        }

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
    
    /**
     * Process map link to extract embeddable URL from various Google Maps formats
     * Handles: embed HTML, regular share links, and already formatted embed URLs
     */
    private function processMapLink($input)
    {
        $input = trim($input);
        
        // If it's already a valid embed URL, return it
        if (strpos($input, 'google.com/maps/embed') !== false) {
            return $input;
        }
        
        // If input contains HTML (embed code), extract the src attribute
        if (strpos($input, '<iframe') !== false) {
            preg_match('/src="([^"]+)"/', $input, $matches);
            if (!empty($matches[1])) {
                return $matches[1];
            }
        }
        
        // If it's a regular Google Maps link, try to convert it to embed format
        // Examples: https://maps.app.goo.gl/xyz or https://www.google.com/maps/...
        if (strpos($input, 'google.com/maps') !== false || strpos($input, 'maps.app.goo.gl') !== false) {
            // Extract coordinates if present
            if (preg_match('/@(-?\d+\.\d+),(-?\d+\.\d+)/', $input, $matches)) {
                $lat = $matches[1];
                $lng = $matches[2];
                return "https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d!2d{$lng}!3d{$lat}!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1";
            }
            
            // Extract place ID if present
            if (preg_match('/\/place\/([^\/\?]+)/', $input, $matches)) {
                $place = urlencode($matches[1]);
                return "https://www.google.com/maps/embed/v1/place?key=&q={$place}";
            }
        }
        
        // Return original if no processing was needed/possible
        return $input;
    }
}
