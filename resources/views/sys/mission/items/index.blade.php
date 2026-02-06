@extends('sys.layout')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Mission Items</h4>
        <div class="d-flex gap-2">
            <a href="{{ route('sys.mission.edit', $mission) }}" class="btn btn-outline-secondary">Back to Section</a>
            <a href="{{ route('sys.mission.items.create', $mission) }}" class="btn btn-primary">Add Item</a>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Column</th>
                        <th>Icon</th>
                        <th>Sort</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                    <tr>
                        <td>{{ $item->title }}</td>
                        <td><span class="badge bg-label-info">{{ $item->column }}</span></td>
                        <td>{{ $item->icon }}</td>
                        <td>{{ $item->sort_order }}</td>
                        <td>
                            @if($item->is_active)
                            <span class="badge bg-label-success">Active</span>
                            @else
                            <span class="badge bg-label-secondary">Hidden</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="{{ route('sys.mission.items.edit', [$mission->id, $item->id]) }}"
                                class="btn btn-sm btn-info">
                                <i class="bx bx-edit"></i>
                            </a>

                            <form class="d-inline" method="POST"
                                action="{{ route('sys.mission.items.destroy', [$mission->id, $item->id]) }}"
                                onsubmit="return confirm('Delete {{ $item->title ?? $item->name ?? 'this item' }}? This cannot be undone.');">
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
                        <td colspan="6" class="text-center py-4">No items yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection