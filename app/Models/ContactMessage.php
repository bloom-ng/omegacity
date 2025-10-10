<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ContactMessage extends Model
{
    use HasFactory;

    protected $table = 'contact_messages';

    protected $fillable = [
        'email',
        'message',
    ];

    /**
     * Accessor to format the created_at timestamp
     * Example: "Sent 5 minutes ago"
     */
    public function getSentAtAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }
}
