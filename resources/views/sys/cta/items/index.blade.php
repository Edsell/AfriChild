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
              <td>{{ $item->percent }}%</td>
              <td>{{ $item->sort_order }}</td>
              <td>
                @if($item->is_active)
                  <span class="badge bg-label-success">Active</span>
                @else
                  <span class="badge bg-label-secondary">Hidden</span>
                @endif
              </td>
              <td class="text-end">
                <a class="btn btn-sm btn-outline-primary"
                   href="{{ route('sys.cta.items.edit', [$cta, $item]) }}">Edit</a>

                <form class="d-inline" method="POST"
                      action="{{ route('sys.cta.items.destroy', [$cta, $item]) }}"
                      onsubmit="return confirm('Delete this item?');">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-sm btn-outline-danger">Delete</button>
                </form>
              </td>
            </tr>
          @empty
            <tr><td colspan="5" class="text-center py-4">No CTA items yet.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

</div>
@endsection
