<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    protected $fillable = [
        'job_id',
        'name',
        'email',
        'phone',
        'cover_letter',
        'status',
    ];

    public function job()
    {
        return $this->belongsTo(EventJob::class, 'job_id');
    }
}
