@extends('sys_views.app', ['title' => 'Dashboard'])

@section('content')
<div class="row">
    <div class="col-12 mb-4">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h4 class="fw-bold mb-1">Admin Dashboard</h4>
                <p class="mb-0 text-muted">Quick access to your CMS modules and content.</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ url('/') }}" target="_blank" class="btn btn-label-primary">
                    <i class="bx bx-link-external me-1"></i> View Website
                </a>
            </div>
        </div>
    </div>
</div>

{{-- Quick stats --}}
<div class="row">
    <div class="col-sm-6 col-lg-2 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <small class="text-muted">Pages</small>
                        <h5 class="mb-0">{{ $stats['pages'] }}</h5>
                    </div>
                    <span class="badge bg-label-primary p-2"><i class="bx bx-file"></i></span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-2 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <small class="text-muted">Blog Posts</small>
                        <h5 class="mb-0">{{ $stats['blogs'] }}</h5>
                    </div>
                    <span class="badge bg-label-info p-2"><i class="bx bx-news"></i></span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-2 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <small class="text-muted">Events</small>
                        <h5 class="mb-0">{{ $stats['events'] }}</h5>
                    </div>
                    <span class="badge bg-label-success p-2"><i class="bx bx-calendar-event"></i></span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-2 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <small class="text-muted">Gallery</small>
                        <h5 class="mb-0">{{ $stats['gallery'] }}</h5>
                    </div>
                    <span class="badge bg-label-warning p-2"><i class="bx bx-images"></i></span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-2 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <small class="text-muted">Team</small>
                        <h5 class="mb-0">{{ $stats['team'] }}</h5>
                    </div>
                    <span class="badge bg-label-secondary p-2"><i class="bx bx-group"></i></span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-2 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <small class="text-muted">Messages</small>
                        <h5 class="mb-0">{{ $stats['messages'] }}</h5>
                    </div>
                    <span class="badge bg-label-danger p-2"><i class="bx bx-envelope"></i></span>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modules grid --}}
<div class="row">
    <div class="col-12 mb-2">
        <h5 class="mb-0">CMS Modules</h5>
        <small class="text-muted">Manage content across the site.</small>
    </div>

    @foreach ($modules as $m)
        <div class="col-md-6 col-xl-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-primary">
                                    <i class="{{ $m['icon'] }}"></i>
                                </span>
                            </div>
                            <div>
                                <h6 class="mb-1">{{ $m['title'] }}</h6>
                                <small class="text-muted">{{ $m['desc'] }}</small>
                            </div>
                        </div>

                        <div class="text-end">
                            <span class="badge bg-label-primary">{{ $m['badge'] }}</span>
                            <div class="mt-2">
                                <span class="fw-semibold">{{ $m['count'] }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        @php
                            $canRoute = \Illuminate\Support\Facades\Route::has($m['route']);
                        @endphp

                        @if($canRoute)
                            <a href="{{ route($m['route']) }}" class="btn btn-primary btn-sm">
                                Open
                            </a>
                        @else
                            <button class="btn btn-primary btn-sm" type="button" disabled title="Route not created yet">
                                Open
                            </button>
                        @endif

                        <button class="btn btn-label-secondary btn-sm" type="button" disabled>
                            Settings
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
