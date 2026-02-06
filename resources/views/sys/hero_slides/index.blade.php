@extends('sys.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h4 class="mb-0">Hero Slides</h4>
  <a class="btn btn-primary" href="{{ route('sys.hero-slides.create') }}">Add</a>
</div>

<div class="card">
  <div class="table-responsive">
    <table class="table">
      <thead>
  <tr>
    <th>ID</th>
    <th>Background</th>
    <th>Thumb</th>
    <th>Title</th>
    <th>Active</th>
    <th class="text-end">Actions</th>
  </tr>
</thead>

<tbody>
@forelse($items as $item)
  <tr>
    <td>{{ $item->id }}</td>

    <td>
      @if($item->background)
        <img src="{{ asset('uploads/'.$item->background) }}" alt="" style="height:45px;width:80px;object-fit:cover;border-radius:6px;">
      @else
        <span class="text-muted">No image</span>
      @endif
    </td>

    <td>
      @if($item->thumb)
        <img src="{{ asset('uploads/'.$item->thumb) }}" alt="" style="height:45px;width:80px;object-fit:cover;border-radius:6px;">
      @else
        <span class="text-muted">No thumb</span>
      @endif
    </td>

    <td class="fw-semibold">{{ $item->title }}</td>
    <td>{{ $item->is_active ? 'Yes' : 'No' }}</td>

    <td class="text-end">
      <a class="btn btn-sm btn-outline-primary" href="{{ route('sys.hero-slides.edit',$item) }}">Edit</a>
      <form action="{{ route('sys.hero-slides.destroy',$item) }}" method="POST" class="d-inline">
        @csrf @method('DELETE')
        <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete?')">Delete</button>
      </form>
    </td>
  </tr>
@empty
  <tr>
    <td colspan="6" class="text-center py-4">No slides yet.</td>
  </tr>
@endforelse
</tbody>

    </table>
  </div>
</div>

<div class="mt-3">{{ $items->links() }}</div>
@endsection
