<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\ContactMessage;
use App\Http\Controllers\Controller;
use App\Models\LandListing;

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

    public function LandPage()
    {
        // Determine top 2 locations by recency of listings
        $locations = LandListing::latest()
            ->pluck('location')
            ->filter()
            ->unique()
            ->take(2)
            ->values();

        $sections = [];
        foreach ($locations as $loc) {
            $sections[] = [
                'location' => $loc,
                'listings' => LandListing::where('location', $loc)
                    ->latest()
                    ->take(3)
                    ->get(),
            ];
        }

        return view("users.land", [
            'sections' => $sections,
        ]);
    }

    public function LandListingPage(int $id)
    {
        $landlisting = LandListing::with('agent')->findOrFail($id);
        $otherListings = LandListing::where('location', $landlisting->location)
            ->where('id', '!=', $landlisting->id)
            ->latest()
            ->take(3)
            ->get();

        return view("users.landlisting", [
            'landlisting' => $landlisting,
            'otherListings' => $otherListings,
        ]);
    }

    public function AboutPage()
    {
        return view("users.about");
    }
}
