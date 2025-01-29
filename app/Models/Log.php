<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    // Define the table name
    protected $table = 'et_logfile';
    public $timestamps = false;  // Disable automatic timestamps

    // Define the fillable fields
    protected $fillable = [
        'id_user',
        'urlpath',
        'action',
        'id_record',
        'dated',
        'ip',
        'remarks',
    ];
}
