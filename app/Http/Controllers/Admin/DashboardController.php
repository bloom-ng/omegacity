<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Eoi;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\Receipt;
use App\Models\Guarantor;
use App\Models\LandListing;
use Illuminate\Http\Request;
use App\Models\ContactMessage;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
  public function index()
{

    $currentMonth = Carbon::now()->month;
    $lastMonth = Carbon::now()->subMonth()->month;


   $stats = [
        'contacts' => [
            'count' => ContactMessage::count(),
            'monthly' => ContactMessage::whereMonth('created_at', $currentMonth)->count(),
            'last_month' => ContactMessage::whereMonth('created_at', $lastMonth)->count(),
        ],
        'clients' => [
            'count' => Client::count(),
            'monthly' => Client::whereMonth('created_at', $currentMonth)->count(),
            'last_month' => Client::whereMonth('created_at', $lastMonth)->count(),
        ],
        'land_listings' => [
            'count' => Landlisting::count(),
            'monthly' => Landlisting::whereMonth('created_at', $currentMonth)->count(),
            'last_month' => Landlisting::whereMonth('created_at', $lastMonth)->count(),
        ],
        'invoices' => [
            'count' => Invoice::count(),
            'monthly' => Invoice::whereMonth('created_at', $currentMonth)->count(),
            'last_month' => Invoice::whereMonth('created_at', $lastMonth)->count(),
        ],
        'receipts' => [
            'count' => Receipt::count(),
            'monthly' => Receipt::whereMonth('created_at', $currentMonth)->count(),
            'last_month' => Receipt::whereMonth('created_at', $lastMonth)->count(),
        ],
    ];


    // recent activities (latest 10 from all models)
    $activities = collect()
        ->merge(ContactMessage::latest()->take(1)->get()->map(fn($i) => [
            'type' => 'Contact Message',
            'name' => $i->message,
            'details' => $i->email,
            'time' => $i->created_at
        ]))
         ->merge(Guarantor::latest()->take(1)->get()->map(fn($i) => [
            'type' => 'Guarantor Form For',
            'name' => $i->candidate_name,
            'details' => $i->guarantor_email,
            'time' => $i->created_at
        ]))
         ->merge(Eoi::latest()->take(1)->get()->map(fn($i) => [
            'type' => 'Expression Of Interest',
            'name' => $i->surname . " " . $i->first_name,
            'details' => $i->email,
            'time' => $i->created_at
        ]))
        ->merge(Client::latest()->take(1)->get()->map(fn($i) => [
            'type' => 'Client',
            'name' => $i->first_name . " " . $i->last_name,
            'details' => $i->email ?? '',
            'time' => $i->created_at
        ]))
        ->merge(Landlisting::latest()->take(1)->get()->map(fn($i) => [
            'type' => 'Land Listing',
            'name' => $i->property_name,
            'details' => $i->location ?? '',
            'time' => $i->created_at
        ]))
        ->merge(Invoice::latest()->take(1)->get()->map(fn($i) => [
            'type' => 'Invoice',
            'name' => "Invoice INV-{$i->created_at->format('Ymd') }{$i->id}",
            'time' => $i->created_at
        ]))
        ->merge(Receipt::latest()->take(1)->get()->map(fn($i) => [
            'type' => 'Receipt',
            'name' => "Receipt REC-{$i->created_at->format('Ymd') }{$i->id}",
            'time' => $i->created_at
        ]))
        ->sortByDesc('time')
        ->take(5);

    return view('admin.dashboard', compact('stats', 'activities'));
}

}
