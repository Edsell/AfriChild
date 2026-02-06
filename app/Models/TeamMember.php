<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $fillable = [
        'name','designation','photo','slug',
        'facebook','twitter','linkedin','instagram',
        'bio','sort_order','is_active', 'type'
    ];

    public const TYPE_BOARD = 'board';
    public const TYPE_SECRETARIAT = 'secretariat';
    public const TYPE_FOUNDING_MEMBERS = 'founding_members';
    public const TYPE_PROMOTING_PARTNERS = 'promoting_partners';

    public static function typeOptions(): array
    {
        return [
            self::TYPE_BOARD => 'Board of Directors',
            self::TYPE_SECRETARIAT => 'Secretariat',
            self::TYPE_FOUNDING_MEMBERS => 'Founding Members',
            self::TYPE_PROMOTING_PARTNERS => 'Promoting Partners',
        ];
    }

    public function scopeType($query, ?string $type)
    {
        return $type ? $query->where('type', $type) : $query;
    }
}
