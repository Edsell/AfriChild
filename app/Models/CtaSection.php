<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CtaSection extends Model
{
    protected $fillable = ['background_image', 'parallax_speed', 'is_active'];

    public function items()
    {
        return $this->hasMany(CtaItem::class);
    }
}
