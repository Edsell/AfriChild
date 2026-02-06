<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Gallery extends Model
{
  protected $fillable = ['name', 'slug', 'is_active', 'sort_order'];

  public function items(): HasMany
  {
    return $this->hasMany(GalleryItem::class);
  }

  public function activeItems(): HasMany
  {
    return $this->items()->where('is_active', 1)->orderBy('sort_order')->orderByDesc('id');
  }

  protected static function booted(): void
  {
    static::saving(function (Gallery $g) {
      $g->name = trim($g->name ?? '');
      if (empty($g->slug)) {
        $g->slug = Str::slug($g->name);
      } else {
        $g->slug = Str::slug($g->slug);
      }

      // Ensure unique slug
      $base = $g->slug;
      $i = 2;
      while (static::where('slug', $g->slug)->when($g->exists, fn($q) => $q->where('id', '!=', $g->id))->exists()) {
        $g->slug = $base.'-'.$i++;
      }
    });
  }
}
