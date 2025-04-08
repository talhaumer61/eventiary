<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events'; // Table name

    protected $primaryKey = 'event_id'; // Custom primary key

    public $timestamps = false; // Since you are using custom timestamp fields

    protected $fillable = [
        'event_status',
        'event_name',
        'event_href',
        'event_location',
        'event_detail',
        'event_budget',
        'no_of_guests',
        'event_date',
        'event_image',
        'id_type',
        'id_added',
        'id_modify',
        'date_added',
        'date_modify',
        'is_deleted',
        'id_deleted',
        'date_deleted',
        'ip_deleted',
    ];
}
