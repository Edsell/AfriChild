<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MissionSection extends Model
{
    protected $fillable = ['title','center_image','is_active'];

    public function items()
    {
        return $this->hasMany(MissionItem::class);
    }
}
