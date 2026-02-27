@extends('sys.layout')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">CTA Items</h4>
        <div class="d-flex gap-2">
            <a href="{{ route('sys.cta.edit', $cta) }}" class="btn btn-outline-secondary">Back to Section</a>
            <a href="{{ route('sys.cta.items.create', $cta) }}" class="btn btn-primary">Add Item</a>
        </div>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Percent</th>
                        <th>Sort</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                    <tr>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->percent }}</td>
                        <td>{{ $item->sort_order }}</td>
                        <td>
                            @if($item->is_active)
                            <span class="badge bg-label-success">Active</span>
                            @else
                            <span class="badge bg-label-secondary">Hidden</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="{{ route('sys.cta.items.edit', [$cta->id, $item->id]) }}"
                                class="btn btn-sm btn-info">
                                <i class="bx bx-edit"></i>
                            </a>

                            <form class="d-inline" method="POST"
                                action="{{ route('sys.cta.items.destroy', [$cta->id, $item->id]) }}"
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
                        <td colspan="5" class="text-center py-4">No CTA items yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection