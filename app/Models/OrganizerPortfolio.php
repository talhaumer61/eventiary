<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrganizerPortfolio extends Model
{
    protected $fillable = [
        'organizer_id',
        'title',
        'description',
        'image'
    ];

    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }
}
