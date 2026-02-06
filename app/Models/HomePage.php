<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomePage extends Model
{
    protected $fillable = [
        'title','slug',
        'meta_title','meta_keywords','meta_description',
        'hero_title','hero_subtitle','hero_button_text','hero_button_url',
        'services_title','services_subtitle','services_button_text','services_button_url',
        'projects_title','projects_subtitle','projects_button_text','projects_button_url',
        'show_hero','show_services','show_projects',
        'is_active',
    ];
}
