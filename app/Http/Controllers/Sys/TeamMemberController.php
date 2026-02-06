<?php

namespace App\Http\Controllers\Sys;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class TeamMemberController extends Controller
{
    public function index(Request $request)
    {
        $q = TeamMember::query();

        if ($request->filled('type')) {
            $q->where('type', $request->string('type'));
        }

        $members = $q->orderBy('sort_order')
            ->orderByDesc('id')
            ->paginate(20)
            ->withQueryString();

        $typeOptions = TeamMember::typeOptions();

        // IMPORTANT: your blade loops $members
        return view('sys.team.index', compact('members', 'typeOptions'));
    }

    public function create()
    {
        $typeOptions = TeamMember::typeOptions();
        return view('sys.team.create', compact('typeOptions'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'type' => ['required', Rule::in(array_keys(TeamMember::typeOptions()))],

            'name' => ['required', 'string', 'max:255'],
            'designation' => ['nullable', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:team_members,slug'],

            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:6144'],

            'facebook' => ['nullable', 'string', 'max:255'],
            'twitter' => ['nullable', 'string', 'max:255'],
            'linkedin' => ['nullable', 'string', 'max:255'],
            'instagram' => ['nullable', 'string', 'max:255'],

            'bio' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['type'] = $data['type'] ?? TeamMember::TYPE_SECRETARIAT;
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_active'] = (bool) $request->input('is_active', 0);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']) . '-' . Str::random(6);
        }

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $name = Str::uuid()->toString() . '.' . $file->getClientOriginalExtension();
            $dir = 'uploads/team';
            $file->move(public_path($dir), $name);
            $data['photo'] = $dir . '/' . $name;
        }

        TeamMember::create($data);

        return redirect()->route('sys.team-members.index')->with('success', 'Team member created.');
    }

    public function edit(TeamMember $team_member)
    {
        $typeOptions = TeamMember::typeOptions();
        return view('sys.team.edit', [
            'member' => $team_member,
            'typeOptions' => $typeOptions,
        ]);
    }

    public function update(Request $request, TeamMember $team_member)
    {
        $data = $request->validate([
            'type' => ['required', Rule::in(array_keys(TeamMember::typeOptions()))],

            'name' => ['required', 'string', 'max:255'],
            'designation' => ['nullable', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:team_members,slug,' . $team_member->id],

            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:6144'],
            'remove_photo' => ['nullable', 'boolean'],

            'facebook' => ['nullable', 'string', 'max:255'],
            'twitter' => ['nullable', 'string', 'max:255'],
            'linkedin' => ['nullable', 'string', 'max:255'],
            'instagram' => ['nullable', 'string', 'max:255'],

            'bio' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['type'] = $data['type'] ?? TeamMember::TYPE_SECRETARIAT;
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_active'] = (bool) $request->input('is_active', 0);

        if ($request->boolean('remove_photo')) {
            if ($team_member->photo && file_exists(public_path($team_member->photo))) {
                @unlink(public_path($team_member->photo));
            }
            $data['photo'] = null;
        }

        if ($request->hasFile('photo')) {
            if ($team_member->photo && file_exists(public_path($team_member->photo))) {
                @unlink(public_path($team_member->photo));
            }

            $file = $request->file('photo');
            $name = Str::uuid()->toString() . '.' . $file->getClientOriginalExtension();
            $dir = 'uploads/team';
            $file->move(public_path($dir), $name);
            $data['photo'] = $dir . '/' . $name;
        }

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']) . '-' . Str::random(6);
        }

        $team_member->update($data);

        return redirect()->route('sys.team-members.index')->with('success', 'Team member updated.');
    }

    public function destroy(TeamMember $team_member)
    {
        if ($team_member->photo && file_exists(public_path($team_member->photo))) {
            @unlink(public_path($team_member->photo));
        }

        $team_member->delete();

        return redirect()->route('sys.team-members.index')->with('success', 'Team member deleted.');
    }
}
