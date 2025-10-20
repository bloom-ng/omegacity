<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'source',
        'budget_range',
        'interested_land_id',
        'follow_up_date',
        'remark',
        'status',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

     // Relationships
    public function landInterest()
    {
        return $this->belongsTo(LandListing::class, 'interested_land_id');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }

    // Accessor
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
