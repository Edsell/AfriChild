@extends('sys.layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Blog Posts</h4>
        <div class="d-flex gap-2">
            <a class="btn btn-outline-primary" href="{{ route('sys.categories.index') }}">Manage Categories</a>
            <a class="btn btn-primary" href="{{ route('sys.posts.create') }}">Add Post</a>
        </div>
    </div>



    <div class="card">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width:90px;">Image</th>
                        <th>Title</th>
                        <th>Categories</th>
                        <th>Status</th>
                        <th>Published</th>
                        <th>Sort</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($posts as $p)
                    <tr>
                        <td>
                            @if($p->image)
                            <img src="{{ asset($p->image) }}"
                                style="height:40px;width:60px;object-fit:cover;border-radius:8px;">
                            @endif
                        </td>

                        <td>
                            <div class="fw-semibold">{{ $p->title }}</div>
                            <small class="text-muted">{{ $p->slug }}</small>
                        </td>

                        <td>
                            @if($p->categories?->count())
                            <div class="d-flex flex-wrap gap-1">
                                @foreach($p->categories as $c)
                                <span class="badge bg-label-info">{{ $c->name }}</span>
                                @endforeach
                            </div>
                            @else
                            <span class="text-muted">—</span>
                            @endif
                        </td>

                        <td>
                            @if($p->is_published)
                            <span class="badge bg-label-success">Published</span>
                            @else
                            <span class="badge bg-label-secondary">Draft</span>
                            @endif
                        </td>

                        <td>{{ $p->published_at ? $p->published_at->format('M d, Y') : '-' }}</td>
                        <td>{{ $p->sort_order }}</td>

                        <td class="text-end">
                            <a href="{{ route('sys.posts.edit', $p->id) }}" class="btn btn-sm btn-info">
                                <i class="bx bx-edit"></i>
                            </a>

                            <form class="d-inline" method="POST" action="{{ route('sys.posts.destroy', $p->id) }}"
                                onsubmit="return confirm('Delete {{ $p->title ?? 'this post' }}? This cannot be undone.');">
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
                        <td colspan="7" class="text-center py-4">No posts yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
