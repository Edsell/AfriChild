@extends('sys_views.layout')

@section('content')
@include('sys_views.breadcrumbs', ['title' => 'Blog Posts'])

<div class="card">
  <div class="card-body d-flex justify-content-between">
    <h5 class="mb-0">Posts</h5>
    <a class="btn btn-primary" href="{{ route('sys.blog.create') }}">New</a>
  </div>

  <div class="table-responsive">
    <table class="table">
      <thead><tr><th>Title</th><th>Status</th><th></th></tr></thead>
      <tbody>
        @foreach($posts as $post)
          <tr>
            <td>{{ $post->title }}</td>
            <td>{{ $post->is_published ? 'Published' : 'Draft' }}</td>
            <td class="text-end">
              <a class="btn btn-sm btn-outline-secondary" href="{{ route('sys.blog.edit', $post) }}">Edit</a>
              <form class="d-inline" method="POST" action="{{ route('sys.blog.destroy', $post) }}">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete?')">Delete</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <div class="card-body">{{ $posts->links() }}</div>
</div>
@endsection
