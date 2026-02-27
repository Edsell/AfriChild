<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CtaItem extends Model
{
    protected $fillable = [
        'cta_section_id',
        'title',
        'percent',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'cta_section_id' => 'integer',
        'percent'        => 'integer',
        'sort_order'     => 'integer',
        'is_active'      => 'boolean',
    ];

    public function section()
    {
        return $this->belongsTo(CtaSection::class, 'cta_section_id');
    }
}