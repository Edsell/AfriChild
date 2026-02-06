@extends('sys.layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Categories</h4>
    <div class="d-flex gap-2">
      <a class="btn btn-outline-secondary" href="{{ route('sys.posts.index') }}">Back to Posts</a>
      <a class="btn btn-primary" href="{{ route('sys.categories.create') }}">Add Category</a>
    </div>
  </div>

  <div class="card">
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>Name</th>
            <th>Slug</th>
            <th>Posts</th>
            <th class="text-end">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($categories as $c)
            <tr>
              <td class="fw-semibold">{{ $c->name }}</td>
              <td><span class="text-muted">{{ $c->slug }}</span></td>
              <td>{{ $c->posts_count ?? 0 }}</td>
              <td class="text-end">
                <a class="btn btn-sm btn-outline-primary" href="{{ route('sys.categories.edit', $c) }}">Edit</a>
                <form class="d-inline" method="POST" action="{{ route('sys.categories.destroy', $c) }}"
                      onsubmit="return confirm('Delete this category?');">
                  @csrf @method('DELETE')
                  <button class="btn btn-sm btn-outline-danger">Delete</button>
                </form>
              </td>
            </tr>
          @empty
            <tr><td colspan="4" class="text-center py-4">No categories yet.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
