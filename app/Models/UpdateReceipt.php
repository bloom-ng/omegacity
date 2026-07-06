<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UpdateReceipt extends Model
{
    use HasFactory;

    protected $table = 'update_receipts';

    protected $fillable = [
        'client_id',
        'date',
        'receipt_items',
        'tax',
        'discount',
        'payment_type',
        'grand_total',
        'amount_paid',
        'balance_due',
    ];

    protected $casts = [
        'date' => 'date:Y-m-d',
        'receipt_items' => 'array',
        'tax' => 'decimal:2',
        'discount' => 'decimal:2',
        'grand_total' => 'decimal:2',
        'amount_paid' => 'decimal:2',
        'balance_due' => 'decimal:2',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }


    public function getReceiptNumberAttribute()
    {
        $date = $this->created_at ?? now();
        return 'REC-' . $date->format('Ymd') . $this->id;
    }   
}
