<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AgentTarget extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'period_type',
        'target_type', 
        'target_value',
        'achieved_value',
        'year',
        'month',
        'notes',
        'status'
    ];

    protected $casts = [
        'target_value' => 'decimal:2',
        'achieved_value' => 'decimal:2',
    ];

    // Relations
    public function agent()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Accessors
    public function getProgressPercentageAttribute()
    {
        return $this->target_value > 0 
            ? round(($this->achieved_value / $this->target_value) * 100, 2)
            : 0;
    }

    public function getRemainingAttribute()
    {
        return max(0, $this->target_value - $this->achieved_value);
    }

    public function getIsAchievedAttribute()
    {
        return $this->achieved_value >= $this->target_value;
    }

    public function getFormattedTargetValueAttribute()
    {
        if ($this->target_type === 'amount') {
            return '₦' . number_format($this->target_value, 2);
        }
        return number_format($this->target_value) . ' sales';
    }

    public function getFormattedAchievedValueAttribute()
    {
        if ($this->target_type === 'amount') {
            return '₦' . number_format($this->achieved_value, 2);
        }
        return number_format($this->achieved_value) . ' sales';
    }

    // Scopes
    public function scopeForAgent($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeMonthly($query)
    {
        return $query->where('period_type', 'monthly');
    }

    public function scopeYearly($query)
    {
        return $query->where('period_type', 'yearly');
    }

    public function scopeAmount($query)
    {
        return $query->where('target_type', 'amount');
    }

    public function scopeSales($query)
    {
        return $query->where('target_type', 'sales');
    }

    public function scopeForPeriod($query, $year, $month = null)
    {
        $query->where('year', $year);
        
        if ($month !== null) {
            $query->where('month', $month);
        } else {
            $query->whereNull('month');
        }
        
        return $query;
    }
}
