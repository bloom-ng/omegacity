<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\LandListing;
use App\Services\AgentTargetService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $targetService;
    
    public function __construct(AgentTargetService $targetService)
    {
        $this->targetService = $targetService;
    }
    
    /**
     * Show agent dashboard
     */
    public function index()
    {
        $agent = auth()->user();
        
        if (!$agent->isAgent()) {
            return redirect()->route('admin.dashboard')
                ->with('error', 'Access denied. You are not an agent.');
        }
        
        $currentYear = now()->year;
        
        // Get agent summary (monthly, quarterly, yearly targets and progress)
        $summary = $this->targetService->getAgentSummary($agent->id, $currentYear);
        
        // Get agent's assigned clients
        $recentClients = $agent->assignedClients()
            ->latest()
            ->limit(5)
            ->get();
            
        $totalClients = $agent->assignedClients()->count();
        
        // Get agent's assigned land listings
        $assignedLandListings = $agent->assignedLandListings()
            ->latest()
            ->limit(5)
            ->get();
            
        $totalLandListings = $agent->assignedLandListings()->count();
        
        // Quick stats
        $stats = [
            'total_clients' => $totalClients,
            'total_land_listings' => $totalLandListings,
            'clients_this_month' => $agent->assignedClients()
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', $currentYear)
                ->count(),
            'prospects' => $agent->assignedClients()
                ->where('status', 'prospect')
                ->count(),
        ];
        
        return view('agent.dashboard', compact(
            'agent',
            'summary', 
            'recentClients',
            'assignedLandListings',
            'stats',
            'currentYear'
        ));
    }
    
    /**
     * Show agent's clients
     */
    public function clients(Request $request)
    {
        $agent = auth()->user();
        
        if (!$agent->isAgent()) {
            return redirect()->route('admin.dashboard')
                ->with('error', 'Access denied. You are not an agent.');
        }
        
        $query = $agent->assignedClients();
        
        // Search filter
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }
        
        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }
        
        $clients = $query->latest()->paginate(10)->withQueryString();
        
        return view('agent.clients.index', compact('clients'));
    }
    
    /**
     * Show form to create a new client (auto-assigned to agent)
     */
    public function createClient()
    {
        $agent = auth()->user();
        
        if (!$agent->isAgent()) {
            return redirect()->route('admin.dashboard')
                ->with('error', 'Access denied. You are not an agent.');
        }
        
        // Get available land listings for the interested_land_id dropdown
        $landListings = LandListing::where('status', 'available')->get();
        
        return view('agent.clients.create', compact('landListings'));
    }
    
    /**
     * Store a new client created by agent (auto-assign to agent)
     */
    public function storeClient(Request $request)
    {
        $agent = auth()->user();
        
        if (!$agent->isAgent()) {
            return redirect()->route('admin.dashboard')
                ->with('error', 'Access denied. You are not an agent.');
        }
        
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
        ]);
        
        // Auto-assign to current agent
        $validated['assigned_agent_id'] = $agent->id;
        
        $client = Client::create($validated);
        
        return redirect()->route('agent.clients')
            ->with('success', 'Client created and assigned to you successfully.');
    }
    
    /**
     * Show agent's targets and progress details
     */
    public function targets()
    {
        $agent = auth()->user();
        
        if (!$agent->isAgent()) {
            return redirect()->route('admin.dashboard')
                ->with('error', 'Access denied. You are not an agent.');
        }
        
        $currentYear = now()->year;
        $summary = $this->targetService->getAgentSummary($agent->id, $currentYear);
        $analytics = $this->targetService->getAgentAnalytics($agent->id, $currentYear);
        $targets = $this->targetService->getAgentTargets($agent->id, $currentYear);
        
        return view('agent.targets', compact(
            'agent',
            'summary',
            'analytics', 
            'targets',
            'currentYear'
        ));
    }
}
