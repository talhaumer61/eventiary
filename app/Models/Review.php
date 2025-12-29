<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'assignment_id',
        'from',
        'to',
        'rating',
        'review'
    ];

    // Reviewer (Client)
    public function reviewer()
    {
        return $this->belongsTo(User::class, 'from');
    }

    // Receiver (Organizer)
    public function organizer()
    {
        return $this->belongsTo(User::class, 'to');
    }
}

