<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Tag extends Model
{
  protected $fillable = [
    'name','slug','meta_title','meta_description'
  ];

  public function posts(): BelongsToMany
  {
    return $this->belongsToMany(Post::class);
  }

  protected static function booted(): void
  {
    static::saving(function (Tag $tag) {
      if (blank($tag->slug) && filled($tag->name)) {
        $tag->slug = Str::slug($tag->name);
      }
    });
  }
}
