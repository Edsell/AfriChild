@extends('sys.layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="card">
    <div class="card-body">
      <div class="d-flex align-items-center justify-content-between mb-3">
        <h4 class="mb-0">Upload Images: {{ $gallery->name }}</h4>
        <a class="btn btn-outline-secondary" href="{{ route('sys.galleries.items.index', $gallery) }}">Back</a>
      </div>

      <form method="POST" action="{{ route('sys.galleries.items.store', $gallery) }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
          <label class="form-label">Select Images (multiple)</label>
          <input class="form-control" type="file" name="images[]" multiple accept="image/*" required>
          @error('images')<small class="text-danger">{{ $message }}</small>@enderror
          @error('images.*')<small class="text-danger d-block">{{ $message }}</small>@enderror
          <div class="form-text">You can select many images at once.</div>
        </div>

        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Alt (optional, applied to all)</label>
            <input name="alt" value="{{ old('alt') }}" class="form-control">
          </div>
          <div class="col-md-3">
            <label class="form-label">Sort Order (applied to all)</label>
            <input type="number" min="0" name="sort_order" value="{{ old('sort_order', 0) }}" class="form-control">
          </div>
          <div class="col-md-3 d-flex align-items-end">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }}>
              <label class="form-check-label">Active</label>
            </div>
          </div>
        </div>

        <div class="mt-4">
          <button class="btn btn-primary" type="submit">Upload</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
