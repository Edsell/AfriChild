<div class="col-12">
  <div class="card">
    <div class="card-header">
      <h5 class="mb-1">{{ $Title }}</h5>
      <div class="text-muted">{{ $Desc }}</div>
    </div>

    <div class="card-body">
      <form method="POST" action="{{ route('sys.users.store') }}">
        @csrf
        @include('sys.users._form', ['mode' => 'create'])
        <div class="mt-4 d-flex gap-2">
          <button class="btn btn-primary">Create User</button>
          <a href="{{ route('sys.users.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
      </form>
    </div>
  </div>
</div>
