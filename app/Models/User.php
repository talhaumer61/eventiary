<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'photo',
        'phone',
        'id_role',
        'login_type',
        'status',
        'stripe_account_id',
        'stripe_onboarded',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public $timestamps = true;

    public function getAvatarAttribute()
    {
        return asset($this->photo ?? 'images/default_user.png');
    }

    public function services()
    {
        return $this->hasMany(VendorService::class, 'id_vendor');
    }

    // Bcrypt is automatically applied using setPasswordAttribute
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

}