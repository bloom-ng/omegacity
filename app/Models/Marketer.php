<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marketer extends Model
{
      protected $fillable = [
        'passport',
        'full_name',
        'phone',
        'email',
        'address',
        'dob',
        'occupation',
        'bank_name',
        'account_name',
        'account_number',
        'signature',
        'id_type',
        'id_file',
        'gender',
        'contact_staff',
    ];

    protected $casts = [
        'dob' => 'date',
    ];
}
