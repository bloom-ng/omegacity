<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesTracking extends Model
{
     protected $fillable = [
        'name','phone','email','address','id_type','nok_name','nok_phone','occupation',
        'registration_date','sales_rep','project_name','property_type','plot_unit_no',
        'location','size','total_price','payment_option','initial_deposit','initial_date',
        'total_paid','outstanding_balance','next_due_payment','payment_status',
        'last_payment_date','handled_by','comments'
    ];

    public function payments()
{
    return $this->hasMany(SalesPayment::class);
}
}
