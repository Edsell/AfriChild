<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Event extends Model
{
    protected $fillable = [
        'title','slug','excerpt','description',
        'event_date','event_time','venue','location',
        'image','is_featured','sort_order','status'
    ];

    protected $casts = [
        'event_date' => 'date',
        'event_time' => 'string',
        'is_featured' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function scopePublished($q)
    {
        return $q->where('status', 'published');
    }

    public function getImageUrlAttribute(): string
    {
        if (!$this->image) return asset('assets/img/placeholder-500x500.jpg');
        return asset($this->image);
    }

    public function getEventDatePrettyAttribute(): string
    {
        return $this->event_date?->format('D d M Y') ?? '';
    }

    public function getEventTimePrettyAttribute(): ?string
    {
        if (!$this->event_time) return null;
        // event_time stored as "HH:MM:SS" or "HH:MM"
        try {
            return Carbon::createFromFormat('H:i:s', $this->event_time)->format('g:i a');
        } catch (\Throwable $e) {
            try {
                return Carbon::createFromFormat('H:i', $this->event_time)->format('g:i a');
            } catch (\Throwable $e2) {
                return null;
            }
        }
    }
}
