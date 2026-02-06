@extends('sys.layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="card">
    <div class="card-body">
      <h4 class="mb-3">Create Gallery</h4>

      <form method="POST" action="{{ route('sys.galleries.store') }}">
        @csrf

        <div class="mb-3">
          <label class="form-label">Name</label>
          <input name="name" value="{{ old('name') }}" class="form-control" required>
          @error('name')<small class="text-danger">{{ $message }}</small>@enderror
        </div>

        <div class="mb-3">
          <label class="form-label">Slug (optional)</label>
          <input name="slug" value="{{ old('slug') }}" class="form-control">
          @error('slug')<small class="text-danger">{{ $message }}</small>@enderror
        </div>

        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Sort Order</label>
            <input type="number" min="0" name="sort_order" value="{{ old('sort_order', 0) }}" class="form-control">
          </div>
          <div class="col-md-6 d-flex align-items-end">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }}>
              <label class="form-check-label">Active</label>
            </div>
          </div>
        </div>

        <div class="mt-4 d-flex gap-2">
          <button class="btn btn-primary" type="submit">Save</button>
          <a class="btn btn-outline-secondary" href="{{ route('sys.galleries.index') }}">Back</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
