<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Category extends Model
{
  protected $fillable = [
    'name','slug','meta_title','meta_description','meta_keywords'
  ];

  public function posts(): BelongsToMany
  {
    return $this->belongsToMany(Post::class);
  }

  protected static function booted(): void
  {
    static::saving(function (Category $category) {
      if (blank($category->slug) && filled($category->name)) {
        $category->slug = Str::slug($category->name);
      }
    });
  }
}
