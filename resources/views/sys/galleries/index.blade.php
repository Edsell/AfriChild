@extends('sys.layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

  <div class="d-flex align-items-center justify-content-between mb-3">
    <h4 class="mb-0">Galleries</h4>
    <a href="{{ route('sys.galleries.create') }}" class="btn btn-primary">Add Gallery</a>
  </div>

 
  <div class="card">
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>Name</th>
            <th>Slug</th>
            <th class="text-center">Items</th>
            <th class="text-center">Active</th>
            <th class="text-end">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($items as $g)
            <tr>
              <td class="fw-semibold">{{ $g->name }}</td>
              <td><span class="text-muted">{{ $g->slug }}</span></td>
              <td class="text-center">{{ $g->items_count }}</td>
              <td class="text-center">
                @if($g->is_active)
                  <span class="badge bg-label-success">Yes</span>
                @else
                  <span class="badge bg-label-secondary">No</span>
                @endif
              </td>
              <td class="text-end">
                <a class="btn btn-sm btn-outline-primary" href="{{ route('sys.galleries.edit', $g) }}">Edit</a>
                <a class="btn btn-sm btn-outline-info" href="{{ route('sys.galleries.items.index', $g) }}">Images</a>
                <form class="d-inline" method="POST" action="{{ route('sys.galleries.destroy', $g) }}"
                      onsubmit="return confirm('Delete this gallery and its images?')">
                  @csrf @method('DELETE')
                  <button class="btn btn-sm btn-outline-danger" type="submit">Delete</button>
                </form>
              </td>
            </tr>
          @empty
            <tr><td colspan="5" class="text-center py-4 text-muted">No galleries yet.</td></tr>
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
