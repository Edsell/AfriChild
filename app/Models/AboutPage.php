<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutPage extends Model
{
  protected $fillable = [
    'page_title',
    'meta_title',
    'meta_description',
    'heading',
    'content',
    'image',
    'cta_text',
    'cta_url',
    'is_active',
  ];

  protected $casts = [
    'is_active' => 'boolean',
  ];
}
