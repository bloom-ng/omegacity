<?php

namespace App\Services;

use App\Models\AgentTarget;
use App\Models\Receipt;
use App\Models\Client;
use App\Models\User;
use Carbon\Carbon;

class AgentTargetService
{
    /**
     * Update agent's target progress based on completed sales (receipts)
     */
    public function updateTargetProgress($agentId, $year = null, $month = null)
    {
        $year = $year ?? now()->year;
        $month = $month ?? now()->month;
        
        // Get receipts for this agent's assigned clients
        $receipts = Receipt::whereHas('client', function($q) use ($agentId) {
            $q->where('assigned_agent_id', $agentId);
        })
        ->whereYear('date', $year)
        ->get();
        
        // Monthly targets - calculate for specific month
        $monthlyReceipts = $receipts->filter(function($receipt) use ($year, $month) {
            return $receipt->date->year === $year && $receipt->date->month === $month;
        });
        
        $this->updateTarget($agentId, 'monthly', 'amount', $year, $month, $monthlyReceipts->sum('total'));
        $this->updateTarget($agentId, 'monthly', 'sales', $year, $month, $monthlyReceipts->count());
        
        // Yearly targets - calculate for entire year
        $this->updateTarget($agentId, 'yearly', 'amount', $year, null, $receipts->sum('total'));
        $this->updateTarget($agentId, 'yearly', 'sales', $year, null, $receipts->count());
    }
    
    /**
     * Update a specific target's achieved value
     */
    protected function updateTarget($agentId, $periodType, $targetType, $year, $month, $value)
    {
        $target = AgentTarget::where('user_id', $agentId)
            ->where('period_type', $periodType)
            ->where('target_type', $targetType)
            ->where('year', $year)
            ->where('month', $month)
            ->first();
            
        if ($target) {
            $target->update(['achieved_value' => $value]);
            
            // Auto-update status based on achievement
            if ($value >= $target->target_value) {
                $target->update(['status' => 'achieved']);
            } elseif ($target->status === 'achieved' && $value < $target->target_value) {
                $target->update(['status' => 'active']);
            }
        }
    }
    
    /**
     * Get comprehensive agent summary (monthly, quarterly, yearly)
     */
    public function getAgentSummary($agentId, $year = null)
    {
        $year = $year ?? now()->year;
        $currentMonth = now()->month;
        $currentQuarter = ceil($currentMonth / 3);
        
        return [
            'monthly' => $this->getPeriodSummary($agentId, 'monthly', $year, $currentMonth),
            'quarterly' => $this->getQuarterlySummary($agentId, $year, $currentQuarter),
            'yearly' => $this->getPeriodSummary($agentId, 'yearly', $year, null),
            'agent' => User::find($agentId),
            'year' => $year,
            'current_month' => $currentMonth,
            'current_quarter' => $currentQuarter,
        ];
    }
    
    /**
     * Get targets and achievements for a specific period
     */
    protected function getPeriodSummary($agentId, $periodType, $year, $month)
    {
        $targets = AgentTarget::where('user_id', $agentId)
            ->where('period_type', $periodType)
            ->where('year', $year)
            ->where('month', $month)
            ->get();
            
        return [
            'amount_target' => $targets->where('target_type', 'amount')->first(),
            'sales_target' => $targets->where('target_type', 'sales')->first(),
            'period' => $periodType,
            'year' => $year,
            'month' => $month,
        ];
    }
    
    /**
     * Get quarterly summary with actual achievements
     */
    protected function getQuarterlySummary($agentId, $year, $quarter)
    {
        $startMonth = ($quarter - 1) * 3 + 1;
        $endMonth = $quarter * 3;
        
        // Get receipts for the quarter
        $receipts = Receipt::whereHas('client', function($q) use ($agentId) {
            $q->where('assigned_agent_id', $agentId);
        })
        ->whereYear('date', $year)
        ->whereMonth('date', '>=', $startMonth)
        ->whereMonth('date', '<=', $endMonth)
        ->get();
        
        return [
            'amount_achieved' => $receipts->sum('total'),
            'sales_achieved' => $receipts->count(),
            'quarter' => $quarter,
            'year' => $year,
            'period_name' => "Q{$quarter} {$year}",
            'months' => collect(range($startMonth, $endMonth))->map(function($month) {
                return Carbon::createFromDate(null, $month, 1)->format('M');
            })->join(', '),
        ];
    }
    
    /**
     * Create or update a target for an agent
     */
    public function createOrUpdateTarget($agentId, $periodType, $targetType, $targetValue, $year, $month = null, $notes = null)
    {
        $target = AgentTarget::updateOrCreate(
            [
                'user_id' => $agentId,
                'period_type' => $periodType,
                'target_type' => $targetType,
                'year' => $year,
                'month' => $month,
            ],
            [
                'target_value' => $targetValue,
                'notes' => $notes,
                'status' => 'active'
            ]
        );
        
        // Immediately update progress for this target
        $this->updateTargetProgress($agentId, $year, $month);
        
        return $target;
    }
    
    /**
     * Get all targets for an agent with optional filtering
     */
    public function getAgentTargets($agentId, $year = null, $periodType = null, $status = 'active')
    {
        $query = AgentTarget::forAgent($agentId);
        
        if ($year) {
            $query->where('year', $year);
        }
        
        if ($periodType) {
            $query->where('period_type', $periodType);
        }
        
        if ($status) {
            $query->where('status', $status);
        }
        
        return $query->orderBy('year', 'desc')
                    ->orderBy('month', 'desc')
                    ->orderBy('period_type')
                    ->orderBy('target_type')
                    ->get();
    }
    
    /**
     * Get agent performance analytics
     */
    public function getAgentAnalytics($agentId, $year = null)
    {
        $year = $year ?? now()->year;
        
        $targets = AgentTarget::forAgent($agentId)
            ->where('year', $year)
            ->get();
        
        $monthlyAmountTargets = $targets->where('period_type', 'monthly')->where('target_type', 'amount');
        $monthlySalesTargets = $targets->where('period_type', 'monthly')->where('target_type', 'sales');
        
        return [
            'total_targets_set' => $targets->count(),
            'achieved_targets' => $targets->where('status', 'achieved')->count(),
            'achievement_rate' => $targets->count() > 0 ? 
                round(($targets->where('status', 'achieved')->count() / $targets->count()) * 100, 1) : 0,
            'monthly_amount_performance' => $monthlyAmountTargets->map(function($target) {
                return [
                    'month' => $target->month,
                    'target' => $target->target_value,
                    'achieved' => $target->achieved_value,
                    'percentage' => $target->progress_percentage,
                ];
            }),
            'monthly_sales_performance' => $monthlySalesTargets->map(function($target) {
                return [
                    'month' => $target->month,
                    'target' => $target->target_value,
                    'achieved' => $target->achieved_value,
                    'percentage' => $target->progress_percentage,
                ];
            }),
        ];
    }
    
    /**
     * Batch update progress for all agents
     */
    public function updateAllAgentsProgress($year = null, $month = null)
    {
        $agents = User::whereHas('role', function($q) {
            $q->where('name', 'Agent');
        })->get();
        
        foreach ($agents as $agent) {
            $this->updateTargetProgress($agent->id, $year, $month);
        }
        
        return $agents->count();
    }
}
