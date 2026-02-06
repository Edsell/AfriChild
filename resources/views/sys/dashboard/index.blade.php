@extends('sys_views.app', ['title' => 'Dashboard'])

@section('content')

{{-- Header --}}
<div class="row">
  <div class="col-12 mb-4">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
      <div>
        <h4 class="fw-bold mb-1">Admin Dashboard</h4>
        <p class="mb-0 text-muted">Overview of content, programs, and outreach activity.</p>
      </div>
      <div class="d-flex gap-2">
        <a href="{{ url('/') }}" target="_blank" class="btn btn-label-primary">
          <i class="bx bx-link-external me-1"></i> View Website
        </a>
      </div>
    </div>
  </div>
</div>

{{-- Top: Welcome + Highlights --}}
<div class="row">
  <div class="col-xl-8 mb-4">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-start justify-content-between">
          <div>
            <h5 class="mb-1">Welcome back 👋</h5>
            <p class="text-muted mb-3">
              Here’s what’s happening with AfriChild content and engagement.
            </p>

            <div class="d-flex flex-wrap gap-3">
              <div class="d-flex align-items-center gap-2">
                <span class="badge bg-label-success p-2">
                  <i class="bx bx-envelope"></i>
                </span>
                <div>
                  <small class="text-muted d-block">Messages this month</small>
                  <span class="fw-semibold">{{ $messagesThisMonth ?? 0 }}</span>
                </div>
              </div>

              <div class="d-flex align-items-center gap-2">
                <span class="badge bg-label-info p-2">
                  <i class="bx bx-news"></i>
                </span>
                <div>
                  <small class="text-muted d-block">Posts this month</small>
                  <span class="fw-semibold">{{ $postsThisMonth ?? 0 }}</span>
                </div>
              </div>
            </div>

            <div class="d-flex flex-wrap gap-2 mt-4">
              {{-- Quick actions (route-safe) --}}
              @php
                $quick = [
                  ['label' => 'New Post', 'icon' => 'bx bx-plus-circle', 'route' => 'sys.posts.create'],
                  ['label' => 'New Event', 'icon' => 'bx bx-calendar-plus', 'route' => 'sys.events.create'],
                  ['label' => 'Upload Gallery', 'icon' => 'bx bx-cloud-upload', 'route' => 'sys.galleries.create'],
                ];
              @endphp

              @foreach($quick as $q)
                @if(\Illuminate\Support\Facades\Route::has($q['route']))
                  <a href="{{ route($q['route']) }}" class="btn btn-primary">
                    <i class="{{ $q['icon'] }} me-1"></i> {{ $q['label'] }}
                  </a>
                @else
                  <button type="button" class="btn btn-primary" disabled title="Route not created yet">
                    <i class="{{ $q['icon'] }} me-1"></i> {{ $q['label'] }}
                  </button>
                @endif
              @endforeach
            </div>
          </div>

          <div class="d-none d-md-block">
            {{-- Optional illustration (won’t break layout if missing) --}}
            <img
              src="{{ asset('bootstrap/assets/img/illustrations/man-with-laptop-light.png') }}"
              alt="Dashboard"
              style="max-height: 120px; opacity:.9;"
              onerror="this.style.display='none';"
            />
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Mini summary card --}}
  <div class="col-xl-4 mb-4">
    <div class="card h-100">
      <div class="card-body">
        <h6 class="mb-2">At a glance</h6>
        <div class="d-flex flex-column gap-3">

          <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2">
              <span class="badge bg-label-primary p-2"><i class="bx bx-file"></i></span>
              <span class="text-muted">Pages</span>
            </div>
            <span class="fw-semibold">{{ $stats['pages'] ?? 0 }}</span>
          </div>

          <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2">
              <span class="badge bg-label-info p-2"><i class="bx bx-news"></i></span>
              <span class="text-muted">Blog Posts</span>
            </div>
            <span class="fw-semibold">{{ $stats['blogs'] ?? 0 }}</span>
          </div>

          <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2">
              <span class="badge bg-label-success p-2"><i class="bx bx-calendar-event"></i></span>
              <span class="text-muted">Events</span>
            </div>
            <span class="fw-semibold">{{ $stats['events'] ?? 0 }}</span>
          </div>

          <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2">
              <span class="badge bg-label-warning p-2"><i class="bx bx-bulb"></i></span>
              <span class="text-muted">Projects</span>
            </div>
            <span class="fw-semibold">{{ $stats['projects'] ?? 0 }}</span>
          </div>

          <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2">
              <span class="badge bg-label-danger p-2"><i class="bx bx-envelope"></i></span>
              <span class="text-muted">Messages</span>
            </div>
            <span class="fw-semibold">{{ $stats['messages'] ?? 0 }}</span>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

{{-- Stats Cards (compact + attractive) --}}
<div class="row">
  @php
    $cards = [
      ['label'=>'Pages','val'=>$stats['pages'] ?? 0,'icon'=>'bx bx-file','bg'=>'primary'],
      ['label'=>'Blog Posts','val'=>$stats['blogs'] ?? 0,'icon'=>'bx bx-news','bg'=>'info'],
      ['label'=>'Events','val'=>$stats['events'] ?? 0,'icon'=>'bx bx-calendar-event','bg'=>'success'],
      ['label'=>'Projects','val'=>$stats['projects'] ?? 0,'icon'=>'bx bx-bulb','bg'=>'warning'],
      ['label'=>'Gallery','val'=>$stats['gallery'] ?? 0,'icon'=>'bx bx-images','bg'=>'warning'],
      ['label'=>'Team','val'=>$stats['team'] ?? 0,'icon'=>'bx bx-group','bg'=>'secondary'],
      ['label'=>'Messages','val'=>$stats['messages'] ?? 0,'icon'=>'bx bx-envelope','bg'=>'danger'],
    ];
  @endphp

  @foreach($cards as $c)
    <div class="col-sm-6 col-lg-3 mb-4">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center justify-content-between">
            <div>
              <small class="text-muted">{{ $c['label'] }}</small>
              <h5 class="mb-0">{{ $c['val'] }}</h5>
            </div>
            <span class="badge bg-label-{{ $c['bg'] }} p-2">
              <i class="{{ $c['icon'] }}"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
  @endforeach
</div>

{{-- Activity row --}}
<div class="row">
  {{-- Recent messages --}}
  <div class="col-xl-5 mb-4">
    <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between">
        <div>
          <h6 class="mb-0">Recent Messages</h6>
          <small class="text-muted">Latest contact form submissions</small>
        </div>
        @if(\Illuminate\Support\Facades\Route::has('sys.messages.index'))
          <a href="{{ route('sys.messages.index') }}" class="btn btn-sm btn-label-primary">View all</a>
        @endif
      </div>
      <div class="card-body">
        @if(($recentMessages ?? collect())->count())
          <ul class="list-unstyled mb-0">
            @foreach($recentMessages as $msg)
              <li class="d-flex mb-3 pb-3 border-bottom">
                <div class="avatar flex-shrink-0 me-3">
                  <span class="avatar-initial rounded bg-label-danger">
                    <i class="bx bx-envelope"></i>
                  </span>
                </div>
                <div class="w-100">
                  <div class="d-flex justify-content-between">
                    <h6 class="mb-1">{{ $msg->subject ?? 'Message' }}</h6>
                    <small class="text-muted">
                      {{ \Carbon\Carbon::parse($msg->created_at ?? now())->diffForHumans() }}
                    </small>
                  </div>
                  <div class="text-muted small">
                    <span class="fw-semibold">{{ $msg->name ?? 'Visitor' }}</span>
                    @if(!empty($msg->email)) • {{ $msg->email }} @endif
                  </div>
                  @if(!empty($msg->message))
                    <div class="text-muted small mt-1" style="line-height:1.35;">
                      {{ \Illuminate\Support\Str::limit(strip_tags($msg->message), 110) }}
                    </div>
                  @endif
                </div>
              </li>
            @endforeach
          </ul>
        @else
          <div class="text-muted">No messages yet.</div>
        @endif
      </div>
    </div>
  </div>

  {{-- Upcoming events + recent posts --}}
  <div class="col-xl-7 mb-4">
    <div class="row">
      <div class="col-12 mb-4">
        <div class="card">
          <div class="card-header d-flex align-items-center justify-content-between">
            <div>
              <h6 class="mb-0">Upcoming / Latest Events</h6>
              <small class="text-muted">Keep track of engagements</small>
            </div>
            @if(\Illuminate\Support\Facades\Route::has('sys.events.index'))
              <a href="{{ route('sys.events.index') }}" class="btn btn-sm btn-label-success">Manage</a>
            @endif
          </div>
          <div class="card-body">
            @if(($upcomingEvents ?? collect())->count())
              <div class="row g-3">
                @foreach($upcomingEvents as $ev)
                  <div class="col-md-6">
                    <div class="border rounded p-3 h-100">
                      <div class="d-flex justify-content-between align-items-start">
                        <div>
                          <h6 class="mb-1">{{ $ev->title ?? 'Event' }}</h6>
                          <div class="text-muted small">
                            @php
                              $date = $ev->start_date ?? $ev->event_date ?? null;
                            @endphp
                            @if($date)
                              <i class="bx bx-time-five me-1"></i>
                              {{ \Carbon\Carbon::parse($date)->toFormattedDateString() }}
                            @else
                              <i class="bx bx-time-five me-1"></i>
                              {{ \Carbon\Carbon::parse($ev->created_at ?? now())->toFormattedDateString() }}
                            @endif
                          </div>
                          @if(!empty($ev->location))
                            <div class="text-muted small">
                              <i class="bx bx-map me-1"></i> {{ $ev->location }}
                            </div>
                          @endif
                        </div>
                        <span class="badge bg-label-success"><i class="bx bx-calendar-event"></i></span>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            @else
              <div class="text-muted">No events found.</div>
            @endif
          </div>
        </div>
      </div>

      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex align-items-center justify-content-between">
            <div>
              <h6 class="mb-0">Recent Blog Posts</h6>
              <small class="text-muted">Latest published content</small>
            </div>
            @if(\Illuminate\Support\Facades\Route::has('sys.posts.index'))
              <a href="{{ route('sys.posts.index') }}" class="btn btn-sm btn-label-info">Manage</a>
            @endif
          </div>
          <div class="card-body">
            @if(($recentPosts ?? collect())->count())
              <ul class="list-unstyled mb-0">
                @foreach($recentPosts as $p)
                  <li class="d-flex align-items-start mb-3">
                    <div class="avatar flex-shrink-0 me-3">
                      <span class="avatar-initial rounded bg-label-info">
                        <i class="bx bx-news"></i>
                      </span>
                    </div>
                    <div class="w-100">
                      <div class="d-flex justify-content-between">
                        <div class="fw-semibold">{{ $p->title ?? 'Post' }}</div>
                        <small class="text-muted">
                          {{ \Carbon\Carbon::parse($p->created_at ?? now())->diffForHumans() }}
                        </small>
                      </div>
                      @if(!empty($p->slug))
                        <div class="text-muted small">/{{ $p->slug }}</div>
                      @endif
                    </div>
                  </li>
                @endforeach
              </ul>
            @else
              <div class="text-muted">No posts found.</div>
            @endif
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

{{-- Modules grid --}}
<div class="row">
  <div class="col-12 mb-2">
    <h5 class="mb-0">CMS Modules</h5>
    <small class="text-muted">Manage the site from one place.</small>
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
            @php $canRoute = \Illuminate\Support\Facades\Route::has($m['route']); @endphp

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
