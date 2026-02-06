<div class="col-12">
  <div class="card">
    <div class="card-header">
      <h5 class="mb-1">{{ $Title }}</h5>
      <div class="text-muted">{{ $Desc }}</div>
    </div>

    <div class="card-body">
      @include('sys.users._avatar', ['user' => $user])

      <form method="POST" action="{{ route('sys.users.update', $user->id) }}" class="mt-4">
        @csrf
        @method('PUT')
        @include('sys.users._form', ['mode' => 'edit', 'user' => $user])
        <div class="mt-4 d-flex gap-2">
          <button class="btn btn-primary">Save Changes</button>
          <a href="{{ route('sys.users.index') }}" class="btn btn-outline-secondary">Back</a>
        </div>
      </form>
    </div>
  </div>
</div>
