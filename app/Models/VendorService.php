<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorService extends Model
{
    protected $table = 'vendor_services';
    protected $primaryKey = 'service_id';
    public $timestamps = false;

    protected $fillable = [
        'service_name',
        'service_href',
        'service_icon',
        'service_photo',
        'service_desc',
        'service_price',
        'id_vendor',
        'id_type',
        'service_status',
        'id_added',
        'id_modify',
        'date_added',
        'date_modify',
        'is_deleted',
        'id_deleted',
        'date_deleted',
        'ip_deleted',
    ];

    public function type()
    {
        return $this->belongsTo(VendorType::class, 'id_type', 'type_id');
    }

    public function vendor()
    {
        return $this->belongsTo(User::class, 'id_vendor', 'id');
    }
}
