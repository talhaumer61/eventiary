<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';

    protected $fillable = [
        'assignment_id',
        'id_from',
        'id_to',
        'event_id',
        'total_amount',
        'advance_amount',
        'commission',
        'amount_transferred',
        'payment_intent_id',
        'transfer_id',
        'paid_at',
        'released_at',
    ];

    protected $dates = [
        'paid_at',
        'released_at',
    ];
}
