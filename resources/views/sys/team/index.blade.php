@extends('sys.layout')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Team Members</h4>
        <a href="{{ route('sys.team-members.create') }}" class="btn btn-primary">Add Member</a>
    </div>



    <div class="card">

        <div class="card-body border-bottom">
            <form class="row g-2" method="GET" action="{{ route('sys.team-members.index') }}">
                <div class="col-md-4">
                    <label class="form-label">Filter by Type</label>
                    <select name="type" class="form-select" onchange="this.form.submit()">
                        <option value="">All Types</option>
                        @foreach($typeOptions as $val => $label)
                        <option value="{{ $val }}" @selected(request('type')===$val)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-8 d-flex align-items-end justify-content-end">
                    <a href="{{ route('sys.team-members.index') }}" class="btn btn-outline-secondary">Reset</a>
                </div>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Type</th>
                        <th>Sort</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($members as $m)
                    <tr>
                        <td>
                            @if($m->photo)
                            <img src="{{ asset(ltrim($m->photo, '/')) }}"
                                style="height:40px;width:40px;object-fit:cover;border-radius:8px;">
                            @else
                            <div style="height:40px;width:40px;border-radius:8px;background:#f2f2f2;"></div>
                            @endif
                        </td>
                        <td>{{ $m->name }}</td>
                        <td>{{ $m->designation }}</td>
                        <td>
                            <span class="badge bg-label-primary">
                                {{ $typeOptions[$m->type] ?? $m->type }}
                            </span>
                        </td>
                        <td>{{ $m->sort_order }}</td>
                        <td>
                            @if($m->is_active)
                            <span class="badge bg-label-success">Active</span>
                            @else
                            <span class="badge bg-label-secondary">Hidden</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="{{ route('sys.team-members.edit', $m->id) }}" class="btn btn-sm btn-info">
                                <i class="bx bx-edit"></i>
                            </a>

                            <form class="d-inline" method="POST"
                                action="{{ route('sys.team-members.destroy', $m->id) }}"
                                onsubmit="return confirm('Delete {{ $m->name ?? 'this member' }}? This cannot be undone.');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">
                                    <i class="bx bx-trash"></i>
                                </button>
                            </form>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">No team members yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(method_exists($members, 'links'))
        <div class="card-footer">
            {{ $members->links() }}
        </div>
        @endif

    </div>

</div>
@endsection