@extends('sys.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h4 class="mb-0">Home Page Settings</h4>
  <a class="btn btn-primary" href="{{ route('sys.home-pages.create') }}">Add</a>
</div>

<div class="card">
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th>ID</th><th>Title</th><th>Slug</th><th>Active</th><th class="text-end">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($items as $item)
          <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->title }}</td>
            <td>{{ $item->slug }}</td>
            <td>{{ $item->is_active ? 'Yes' : 'No' }}</td>
            <td class="text-end">
              <a class="btn btn-sm btn-outline-primary" href="{{ route('sys.home-pages.edit', $item) }}">Edit</a>
              {{-- <form action="{{ route('sys.home-pages.destroy', $item) }}" method="POST" class="d-inline">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete?')">Delete</button>
              </form> --}}
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<div class="mt-3">{{ $items->links() }}</div>
@endsection
