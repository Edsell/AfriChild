<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSlide extends Model
{
    protected $fillable = [
        'kicker','title','subtitle',
        'background','thumb',
        'button_text','button_url','button_bg',
        'duration_ms',
        'is_active',
    ];

    public function homePage()
    {
        return $this->belongsTo(HomePage::class);
    }
}
