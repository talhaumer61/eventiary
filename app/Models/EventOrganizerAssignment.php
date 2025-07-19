<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class EventOrganizerAssignment extends Model
{
    public $timestamps = false;

    const STATUS_ACCEPTED = 1;
    const STATUS_REJECTED = 2;
    const STATUS_PENDING  = 3;

    protected $fillable = [
        'client_id',
        'event_id',
        'organizer_id',
        'status',
        'description',
        'id_added',
        'id_modify',
        'date_added',
        'date_modify',
    ];

    protected $primaryKey = 'id';

    protected $dates = ['date_added', 'date_modify', 'date_deleted'];

    protected $casts = [
        'status' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        // Automatically set audit fields
        static::creating(function ($model) {
            $model->id_added = Auth::user()->id;
            $model->date_added = now();
        });

        static::updating(function ($model) {
            $model->id_modify = Auth::user()->id;
            $model->date_modify = now();
        });

        static::deleting(function ($model) {
            $model->id_deleted = Auth::user()->id;
            $model->date_deleted = now();
            $model->ip_deleted = request()->ip();
            $model->save();
        });
    }

    // Relationships
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id', 'event_id');
    }

    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer_id', 'id');
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id', 'id');
    }

    // Accessor for human-readable status
    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            self::STATUS_ACCEPTED => 'Accepted',
            self::STATUS_REJECTED => 'Rejected',
            self::STATUS_PENDING  => 'Pending',
            default               => 'Unknown',
        };
    }
}
