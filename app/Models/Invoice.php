<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'date',
        'invoice_items',
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
       'invoice_items' => 'array',
        'tax' => 'decimal:2',
        'discount' => 'decimal:2',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }






}
