@extends('sys.layout')
@section('content')

<div class="col-12">
  <div class="card">
    <div class="card-header d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
      <div>
        <h5 class="mb-1">{{ $Title }}</h5>
        <div class="text-muted">{{ $Desc }}</div>
      </div>

      <div class="d-flex gap-2">
        <form method="GET" action="{{ route('sys.users.index') }}" class="d-flex gap-2">
          <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search name/email">
          <select name="role" class="form-select">
            <option value="">All roles</option>
            @foreach(($roles ?? []) as $r)
              <option value="{{ $r }}" @selected(request('role') === $r)>{{ ucfirst($r) }}</option>
            @endforeach
          </select>
          <button class="btn btn-outline-primary">Filter</button>
        </form>

        <a href="{{ route('sys.users.create') }}" class="btn btn-primary">
          <i class="bx bx-plus"></i> New User
        </a>
      </div>
    </div>

    <div class="card-body">
      <div class="table-responsive">
        <table class="table align-middle">
          <thead>
            <tr>
              <th>User</th>
              <th>Email</th>
              <th>Role</th>
              <th class="text-end">Actions</th>
            </tr>
          </thead>

          <tbody>
            @forelse($users as $u)
              <tr>
                <td>
                  <div class="d-flex align-items-center gap-2">
                    <img
                      src="{{ $u->avatar ? asset($u->avatar) : asset('bootstrap/assets/img/avatars/1.png') }}"
                      class="rounded"
                      style="width:38px;height:38px;object-fit:cover;"
                      alt="avatar"
                    />
                    <div class="d-flex flex-column">
                      <span class="fw-semibold">{{ $u->name }}</span>
                      <small class="text-muted">#{{ $u->id }}</small>
                    </div>
                  </div>
                </td>
                <td>{{ $u->email }}</td>
                <td><span class="badge bg-label-primary">{{ ucfirst($u->role ?? 'reader') }}</span></td>

                <td class="text-end">
                  <a href="{{ route('sys.users.edit', $u->id) }}" class="btn btn-sm btn-info">
                    <i class="bx bx-edit"></i>
                  </a>

                  <form action="{{ route('sys.users.destroy', $u->id) }}" method="POST" class="d-inline"
                        onsubmit="return confirm('Delete {{ $u->name }}? This cannot be undone.')">
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
                <td colspan="4" class="text-center text-muted py-4">No users found.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <div class="mt-3">
        {{ $users->links() }}
      </div>
    </div>
  </div>
</div>
@endsection