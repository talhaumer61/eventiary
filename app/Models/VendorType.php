<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorType extends Model
{
    protected $table = 'vendor_types';
    protected $primaryKey = 'type_id';
    public $timestamps = false;

    protected $fillable = [
        'type_name', 'type_href', 'type_icon', 'type_photo', 'type_desc',
        'type_status', 'id_added', 'id_modify', 'date_added', 'date_modify',
        'is_deleted', 'id_deleted', 'date_deleted', 'ip_deleted',
    ];
}
