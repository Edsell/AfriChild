@extends('sys.layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Partners</h4>
        <a class="btn btn-primary" href="{{ route('sys.partners.create') }}">Add Partner</a>
    </div>



    <div class="card">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Logo</th>
                        <th>Name</th>
                        <th>URL</th>
                        <th>Sort</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($partners as $p)
                    <tr>
                        <td>
                            @if($p->logo)
                            <img src="{{ asset(ltrim($p->logo,'/')) }}"
                                style="height:40px;width:80px;object-fit:contain;border-radius:8px;">
                            @endif
                        </td>
                        <td>{{ $p->name }}</td>
                        <td>{{ $p->url }}</td>
                        <td>{{ $p->sort_order }}</td>
                        <td>
                            @if($p->is_active)
                            <span class="badge bg-label-success">Active</span>
                            @else
                            <span class="badge bg-label-secondary">Hidden</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="{{ route('sys.partners.edit', $p->id) }}" class="btn btn-sm btn-info">
                                <i class="bx bx-edit"></i>
                            </a>

                            <form class="d-inline" method="POST" action="{{ route('sys.partners.destroy', $p->id) }}"
                                onsubmit="return confirm('Delete {{ $p->name ?? $p->title ?? 'this partner' }}? This cannot be undone.');">
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
                        <td colspan="6" class="text-center py-4">No partners yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection