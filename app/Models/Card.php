<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = [
        'event_id',
        'template',
        'background_color',
        'font_family',
        'text_color',
        'image_path',
        'card_data',
    ];

    protected $casts = [
        'card_data' => 'array',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id', 'event_id');
    }

}
