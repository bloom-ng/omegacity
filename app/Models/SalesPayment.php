<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesPayment extends Model
{
    protected $fillable = ['sales_tracking_id', 'amount_due', 'amount_paid', 'date_paid', 'method'];

    public function salesTracking()
    {
        return $this->belongsTo(SalesTracking::class);
    }
}
