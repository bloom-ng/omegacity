<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Receipt extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'receipt_number',
        'client_id',
        'date',
        'description',
        'quantity',
        'price',
        'tax',
        'discount',
        'total',
    ];

    protected $dates = [
        'date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'date' => 'date:Y-m-d',
        'price' => 'decimal:2',
        'tax' => 'decimal:2',
        'discount' => 'decimal:2',
        'total' => 'decimal:2',
    ];


 public function client()
    {
        return $this->belongsTo(Client::class);
    }



    protected static function boot()
    {
        parent::boot();

        static::creating(function ($receipt) {
            if (empty($receipt->receipt_number)) {
                $receipt->receipt_number = static::generateReceiptNumber();
            }
        });
    }

    protected static function generateReceiptNumber()
    {
        $latest = static::latest('id')->first();
        $number = $latest ? $latest->id + 1 : 1;
        return 'REC-' . str_pad($number, 8, '0', STR_PAD_LEFT);
    }
}
