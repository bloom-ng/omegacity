<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'invoice_number',
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


    public function items()
{
    return $this->hasMany(InvoiceItem::class);
}



    protected static function boot()
    {
        parent::boot();

        static::creating(function ($invoice) {
            if (empty($invoice->invoice_number)) {
                $invoice->invoice_number = static::generateInvoiceNumber();
            }
        });
    }

    protected static function generateInvoiceNumber()
    {
        $latest = static::latest('id')->first();
        $number = $latest ? $latest->id + 1 : 1;
        return 'INV-' . str_pad($number, 8, '0', STR_PAD_LEFT);
    }
}
