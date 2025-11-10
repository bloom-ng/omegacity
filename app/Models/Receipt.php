<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Receipt extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'date',
        'receipt_items',
        'tax',
        'discount',
    ];

    protected $dates = [
        'date',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'date' => 'date:Y-m-d',
        'tax' => 'decimal:2',
        'discount' => 'decimal:2',
    ];


 public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Calculate the total from receipt_items, tax, and discount
     */
    public function getTotalAttribute()
    {
        // Get the raw JSON string from database
        $rawItems = $this->attributes['receipt_items'] ?? '[]';
        
        // Decode JSON string to array
        $items = json_decode($rawItems, true) ?? [];
        
        // Calculate subtotal from items
        $subtotal = 0;
        foreach ($items as $item) {
            $quantity = floatval($item['quantity'] ?? 0);
            $price = floatval($item['price'] ?? 0);
            $subtotal += ($quantity * $price);
        }
        
        // Get tax and discount
        $taxPercentage = floatval($this->attributes['tax'] ?? 0);
        $discount = floatval($this->attributes['discount'] ?? 0);
        
        // Calculate tax amount
        $taxAmount = ($subtotal * $taxPercentage) / 100;
        
        // Calculate final total
        $total = ($subtotal + $taxAmount) - $discount;
        
        return round($total, 2);
    }

}
