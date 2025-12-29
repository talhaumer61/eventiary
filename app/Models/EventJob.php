<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventJob extends Model
{
    use HasFactory;
    protected $table = 'event_jobs'; // Table name

    protected $fillable = [
        'event_id', 'user_id', 'title', 'description', 'href', 'category', 'budget', 'location', 'status'
    ];

    public function event() {
        return $this->belongsTo(Event::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function applications() {
        return $this->hasMany(JobApplication::class, 'job_id');
    }
}
