<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrganizerTeamMember extends Model
{
    protected $fillable = [
        'organizer_id', 'name', 'designation', 'photo', 'bio',
        'facebook', 'instagram', 'linkedin'
    ];

    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }
}
