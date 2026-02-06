<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title','slug',
        'description','excerpt',
        'cover','gallery_image',
        'url','client','location',
        'start_date','end_date','published_at',
        'sort_order',
        'meta_title','meta_keywords','meta_description',
        'is_featured','is_active',
    ];

    protected $casts = [
        'start_date'   => 'date',
        'end_date'     => 'date',
        'published_at' => 'datetime',
        'is_featured'  => 'boolean',
        'is_active'    => 'boolean',
    ];

    public function homePage()
    {
        return $this->belongsTo(HomePage::class);
    }

    public function galleryImages()
    {
        return $this->hasMany(\App\Models\ProjectImage::class)->orderBy('sort_order')->orderBy('id');
    }
}
