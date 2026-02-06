@extends('sys.layout')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Services</h4>
    <a class="btn btn-primary" href="{{ route('sys.services.create') }}">Add</a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Order</th>
                    <th>Active</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->sort_order }}</td>
                    <td>{{ $item->is_active ? 'Yes' : 'No' }}</td>
                    <td class="text-end">
                        <a href="{{ route('sys.services.edit', $item->id) }}" class="btn btn-sm btn-info">
                            <i class="bx bx-edit"></i>
                        </a>

                        <form action="{{ route('sys.services.destroy', $item->id) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Delete {{ $item->title ?? $item->name ?? 'this service' }}? This cannot be undone.');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">
                                <i class="bx bx-trash"></i>
                            </button>
                        </form>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $items->links() }}</div>
@endsection