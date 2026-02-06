@extends('sys.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Projects</h4>
    <a class="btn btn-primary" href="{{ route('sys.projects.create') }}">Add Project</a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Published</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td class="fw-semibold">{{ $item->title }}</td>
                    <td>{{ $item->slug }}</td>
                    <td>{{ $item->is_featured ? 'Yes' : 'No' }}</td>
                    <td>{{ $item->is_active ? 'Yes' : 'No' }}</td>
                    <td>{{ optional($item->published_at)->format('Y-m-d') }}</td>
                    <td class="text-end">
                        <a href="{{ route('sys.projects.edit', $item->id) }}" class="btn btn-sm btn-info">
                            <i class="bx bx-edit"></i>
                        </a>

                        <form action="{{ route('sys.projects.destroy', $item->id) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Delete {{ $item->title ?? $item->name ?? 'this project' }}? This cannot be undone.')">
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
                    <td colspan="7" class="text-center py-4">No projects yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">
    {{ $items->links() }}
</div>
@endsection