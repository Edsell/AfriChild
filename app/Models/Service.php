<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'title','slug',
        'description','excerpt',
        'icon_class','image',
        'url',
        'meta_title','meta_keywords','meta_description',
        'sort_order','is_active',
    ];

    public function homePage()
    {
        return $this->belongsTo(HomePage::class);
    }
}
