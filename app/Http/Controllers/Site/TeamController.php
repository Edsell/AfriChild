<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamController extends Controller
{

 private function typeSlugMap(): array
    {
        return [
            'board'              => TeamMember::TYPE_BOARD,
            'secretariat'        => TeamMember::TYPE_SECRETARIAT,
            'founding-members'   => TeamMember::TYPE_FOUNDING_MEMBERS,
            'promoting-partners' => TeamMember::TYPE_PROMOTING_PARTNERS,
        ];
    }

   public function index()
    {
        $teamMembers = TeamMember::where('is_active', 1)
            ->orderBy('sort_order')
            ->get();

        $typeOptions = TeamMember::typeOptions();

        $typeOrder = [
            TeamMember::TYPE_BOARD,
            TeamMember::TYPE_SECRETARIAT,
            TeamMember::TYPE_FOUNDING_MEMBERS,
            TeamMember::TYPE_PROMOTING_PARTNERS,
        ];

        $teamByType = $teamMembers
            ->where('is_active', true)
            ->sortBy('sort_order')
            ->groupBy('type');

        return view('site.team', compact('teamMembers', 'typeOptions', 'typeOrder', 'teamByType'));
    }

     public function type(string $type)
        {
            $map = $this->typeSlugMap();

            abort_unless(isset($map[$type]), 404);

            $typeKey = $map[$type];

            $teamMembers = TeamMember::where('is_active', 1)
                ->where('type', $typeKey)
                ->orderBy('sort_order')
                ->get();

            $typeOptions = TeamMember::typeOptions();
            $typeLabel = $typeOptions[$typeKey] ?? ucfirst(str_replace('_', ' ', $typeKey));

            return view('site.team.type', compact('teamMembers', 'typeKey', 'typeLabel'));
        }

}
