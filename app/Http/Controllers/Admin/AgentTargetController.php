<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AgentTarget;
use App\Models\User;
use App\Models\Role;
use App\Services\AgentTargetService;
use Illuminate\Http\Request;

class AgentTargetController extends Controller
{
    protected $targetService;

    public function __construct(AgentTargetService $targetService)
    {
        $this->targetService = $targetService;
    }

    /**
     * Show agents list with targets overview
     */
    public function index(Request $request)
    {
        $agentRole = Role::where('name', 'Agent')->first();

        if (!$agentRole) {
            return redirect()->back()->with('error', 'Agent role not found. Please create the Agent role first.');
        }

        $search = $request->input('search');

        $agents = User::where('role_id', $agentRole->id)
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->with(['agentTargets' => function ($query) {
                $query->where('year', now()->year)
                    ->where('status', 'active');
            }])
            ->paginate(10);

        return view('admin.targets.index', compact('agents'));
    }


    /**
     * Show form to set targets for a specific agent
     */
    public function create(User $agent)
    {
        if (!$agent->isAgent()) {
            return redirect()->route('admin.targets.index')
                ->with('error', 'User is not an agent.');
        }

        $currentYear = now()->year;
        $currentMonth = now()->month;

        // Get existing targets for this year
        $existingTargets = AgentTarget::forAgent($agent->id)
            ->where('year', $currentYear)
            ->get()
            ->keyBy(function ($target) {
                return $target->period_type . '_' . $target->target_type . '_' . ($target->month ?? 'yearly');
            });

        return view('admin.targets.create', compact('agent', 'currentYear', 'currentMonth', 'existingTargets'));
    }

    /**
     * Store a single target for an agent
     */
    public function store(Request $request, User $agent)
    {
        if (!$agent->isAgent()) {
            return redirect()->route('admin.targets.index')
                ->with('error', 'User is not an agent.');
        }

        $validated = $request->validate([
            'targets.0.period_type' => 'required|in:monthly,yearly',
            'targets.0.target_type' => 'required|in:amount,sales',
            'targets.0.target_value' => 'required|numeric|min:0.01',
            'targets.0.year' => 'required|integer|min:2020|max:2050',
            'targets.0.month' => 'nullable|integer|min:1|max:12',
            'targets.0.notes' => 'nullable|string|max:500',
        ]);

        $targetData = $validated['targets'][0];

        // Validate month requirement for monthly targets
        if ($targetData['period_type'] === 'monthly') {
            $request->validate([
                'targets.0.month' => 'required|integer|min:1|max:12',
            ]);
        }

        // For monthly targets, ensure month is from current month onwards
        if ($targetData['period_type'] === 'monthly') {
            $currentMonth = now()->month;
            $currentYear = now()->year;

            if ($targetData['year'] == $currentYear && $targetData['month'] < $currentMonth) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['targets.0.month' => 'Cannot set targets for past months.']);
            }
        }

        $month = $targetData['period_type'] === 'yearly' ? null : $targetData['month'];

        $target = $this->targetService->createOrUpdateTarget(
            $agent->id,
            $targetData['period_type'],
            $targetData['target_type'],
            $targetData['target_value'],
            $targetData['year'],
            $month,
            $targetData['notes'] ?? null
        );

        // Format success message
        $periodDisplay = $targetData['period_type'] === 'monthly'
            ? \Carbon\Carbon::create($targetData['year'], $targetData['month'], 1)->format('F Y')
            : $targetData['year'];

        $typeDisplay = $targetData['target_type'] === 'amount' ? 'Revenue' : 'Sales';

        $valueDisplay = $targetData['target_type'] === 'amount'
            ? '₦' . number_format($targetData['target_value'], 0)
            : number_format($targetData['target_value'], 0) . ' sales';

        return redirect()->route('admin.targets.show', $agent)
            ->with('success', "Successfully set {$typeDisplay} target for {$periodDisplay}: {$valueDisplay}");
    }

    /**
     * View agent's targets and progress
     */
    public function show(User $agent)
    {
        if (!$agent->isAgent()) {
            return redirect()->route('admin.targets.index')
                ->with('error', 'User is not an agent.');
        }

        $currentYear = now()->year;
        $summary = $this->targetService->getAgentSummary($agent->id, $currentYear);
        $analytics = $this->targetService->getAgentAnalytics($agent->id, $currentYear);

        // Get all targets for this agent (current year)
        $targets = $this->targetService->getAgentTargets($agent->id, $currentYear);

        // Get agent's assigned clients count
        $clientsCount = $agent->assignedClients()->count();

        return view('admin.targets.show', compact(
            'agent',
            'summary',
            'analytics',
            'targets',
            'clientsCount',
            'currentYear'
        ));
    }

    /**
     * Edit a specific target
     */
    public function edit(User $agent, AgentTarget $target)
    {
        if (!$agent->isAgent() || $target->user_id !== $agent->id) {
            return redirect()->route('admin.targets.index')
                ->with('error', 'Invalid agent or target.');
        }

        return view('admin.targets.edit', compact('agent', 'target'));
    }

    /**
     * Update a specific target
     */
    public function update(Request $request, User $agent, AgentTarget $target)
    {
        if (!$agent->isAgent() || $target->user_id !== $agent->id) {
            return redirect()->route('admin.targets.index')
                ->with('error', 'Invalid agent or target.');
        }

        $validated = $request->validate([
            'target_value' => 'required|numeric|min:0',
            'notes' => 'nullable|string|max:500',
            'status' => 'required|in:active,achieved,missed,cancelled',
        ]);

        $target->update($validated);

        // Update progress after changing target value
        $this->targetService->updateTargetProgress(
            $agent->id,
            $target->year,
            $target->month
        );

        return redirect()->route('admin.targets.show', $agent)
            ->with('success', 'Target updated successfully.');
    }

    /**
     * Delete a target
     */
    public function destroy(User $agent, AgentTarget $target)
    {
        if (!$agent->isAgent() || $target->user_id !== $agent->id) {
            return redirect()->route('admin.targets.index')
                ->with('error', 'Invalid agent or target.');
        }

        $target->delete();

        return redirect()->route('admin.targets.show', $agent)
            ->with('success', 'Target deleted successfully.');
    }

    /**
     * Refresh progress for all agents
     */
    public function refreshProgress()
    {
        $agentsUpdated = $this->targetService->updateAllAgentsProgress();

        return redirect()->route('admin.targets.index')
            ->with('success', "Progress updated for {$agentsUpdated} agents.");
    }
}
