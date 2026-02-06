<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MissionItem extends Model
{
    protected $fillable = [
        'mission_section_id','title','description','icon','column','sort_order','is_active'
    ];

    public function section()
    {
        return $this->belongsTo(MissionSection::class, 'mission_section_id');
    }
}
