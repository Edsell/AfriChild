@extends('sys.layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    <div class="d-flex align-items-center justify-content-between mb-3">
        <h4 class="mb-0">About Page</h4>
        <a href="{{ route('sys.about.create') }}" class="btn btn-primary">Add About</a>
    </div>



    <div class="card">
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Page Title</th>
                        <th>Heading</th>
                        <th>Active</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->page_title }}</td>
                        <td>{{ $item->heading }}</td>
                        <td>
                            @if($item->is_active)
                            <span class="badge bg-label-success">Yes</span>
                            @else
                            <span class="badge bg-label-secondary">No</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="{{ route('sys.about.edit', $item->id) }}" class="btn btn-sm btn-info">
                                <i class="bx bx-edit"></i>
                            </a>

                            <form action="{{ route('sys.about.destroy', $item->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Delete {{ $item->page_title ?? $item->meta_title ?? 'this About record' }}? This cannot be undone.')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" type="submit">
                                    <i class="bx bx-trash"></i>
                                </button>
                            </form>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">No About content yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-body">
            {{ $items->links() }}
        </div>
    </div>

</div>
@endsection