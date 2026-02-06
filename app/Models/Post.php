<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Post extends Model
{
    protected $fillable = [
        'title','slug','excerpt','content','image',
        'author_name','is_published','published_at','sort_order'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function categories(): BelongsToMany
    {
    return $this->belongsToMany(\App\Models\Category::class);
    }

    public function tags(): BelongsToMany
    {
    return $this->belongsToMany(\App\Models\Tag::class);
    }

}
