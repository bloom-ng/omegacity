<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LandListing extends Model
{
    use HasFactory;
     protected $fillable = [
        'property_name',
        'location',
        'plot_size',
        'selling_price',
        'status',
        'sales_agent_id',
        'description',
        'photos',
        'map_link',
        'inspection_date',
        'inspection_time',
    ];

    protected $casts = [
        'photos' => 'array',
    ];

    // Relationships
    public function agent()
    {
        return $this->belongsTo(User::class, 'sales_agent_id');
    }

    public function clients()
    {
        return $this->hasMany(Client::class, 'interested_land_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function inspections()
    {
        return $this->hasMany(Inspection::class);
    }

    // Scopes
    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    public function scopeSold($query)
    {
        return $query->where('status', 'sold');
    }

    // Accessor
    public function getFormattedPriceAttribute()
    {
        return '₦' . number_format($this->selling_price, 2);
    }
}
