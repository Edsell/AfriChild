@extends('sys.layout')
@section('title','Events')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    <div class="d-flex align-items-center justify-content-between mb-3">
        <h4 class="mb-0">Events</h4>
        <a href="{{ route('sys.events.create') }}" class="btn btn-primary">Add Event</a>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <form class="row g-2">
                <div class="col-md-5">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                        placeholder="Search title, venue, location">
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select">
                        <option value="">All statuses</option>
                        <option value="published" @selected(request('status')==='published' )>Published</option>
                        <option value="draft" @selected(request('status')==='draft' )>Draft</option>
                    </select>
                </div>
                <div class="col-md-4 d-flex gap-2">
                    <button class="btn btn-outline-primary">Filter</button>
                    <a href="{{ route('sys.events.index') }}" class="btn btn-outline-secondary">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($events as $event)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <img src="{{ $event->image_url }}" class="rounded"
                                    style="width:44px;height:44px;object-fit:cover" alt="">
                                <div>
                                    <div class="fw-semibold">{{ $event->title }}</div>
                                    <small class="text-muted">{{ $event->venue ?? '—' }}</small>
                                </div>
                            </div>
                        </td>
                        <td>{{ $event->event_date?->format('Y-m-d') }}</td>
                        <td>{{ $event->event_time_pretty ?? '—' }}</td>
                        <td>
                            <span class="badge bg-{{ $event->status === 'published' ? 'success' : 'secondary' }}">
                                {{ ucfirst($event->status) }}
                            </span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('sys.events.edit', $event->id) }}" class="btn btn-sm btn-info">
                                <i class="bx bx-edit"></i>
                            </a>

                            <form action="{{ route('sys.events.destroy', $event->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Delete {{ $event->title ?? $event->name ?? 'this event' }}? This cannot be undone.');">
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
                        <td colspan="5" class="text-center py-4">No events found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-body">
            {{ $events->links() }}
        </div>
    </div>

</div>
@endsection