<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventVendorAssignment extends Model
{
    protected $table = 'event_vendor_assignments';
    public $timestamps = false;

    protected $fillable = [
        'client_id',
        'event_id',
        'vendor_id',
        'service_id',
        'status',
        'description',
        'id_added',
        'id_modify',
        'date_added',
        'date_modify',
        'is_deleted',
        'id_deleted',
        'date_deleted',
        'ip_deleted',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id', 'event_id');
    }

    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }
    public function service()
    {
        return $this->belongsTo(VendorService::class, 'service_id', 'service_id');
    }
}
