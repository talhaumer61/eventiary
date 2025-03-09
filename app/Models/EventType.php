<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventType extends Model
{
    use HasFactory;

    protected $table = 'event_types'; // Table name

    protected $primaryKey = 'type_id'; // Custom primary key

    public $timestamps = false; 

    protected $fillable = [
        'type_status',
        'type_name',
        'type_href',
        'type_icon',
        'type_photo',
        'type_desc',
        'id_added',
        'id_modify',
        'date_added',
        'date_modify',
        'is_deleted',
        'id_deleted',
        'date_deleted',
        'ip_deleted'
    ];
}
