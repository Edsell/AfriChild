<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamController extends Controller
{
     public function index(?string $type = null)
    {
        $typeOptions = TeamMember::typeOptions();

        if ($type && !array_key_exists($type, $typeOptions)) {
            $type = TeamMember::TYPE_SECRETARIAT;
        }

        $members = TeamMember::where('is_active', 1)
            ->when($type, fn ($q) => $q->where('type', $type))
            ->orderBy('sort_order')
            ->get();

        return view('site.team', [
            'members' => $members,
            'type' => $type,
            'typeOptions' => $typeOptions,
        ]);
    }
}
