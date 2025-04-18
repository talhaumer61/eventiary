<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $table = 'guests';

    protected $primaryKey = 'id';

    public $timestamps = false; // We are using custom timestamp columns

    protected $fillable = [
        'status',
        'name',
        'href',
        'address',
        'photo',
        'id_event',
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
