@extends('sys.layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">


  <div class="card">
    <div class="card-body">
      <div class="d-flex align-items-center justify-content-between mb-3">
        <h4 class="mb-0">Edit Image: {{ $gallery->name }}</h4>
        <a class="btn btn-outline-secondary" href="{{ route('sys.galleries.items.index', $gallery) }}">Back</a>
      </div>

      <div class="mb-3">
        <img src="{{ asset($item->image) }}" alt="" style="max-width:320px;border-radius:12px;object-fit:cover;">
      </div>

      <form method="POST" action="{{ route('sys.galleries.items.update', [$gallery, $item]) }}" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="mb-3">
          <label class="form-label">Replace Image (optional)</label>
          <input class="form-control" type="file" name="image" accept="image/*">
          @error('image')<small class="text-danger">{{ $message }}</small>@enderror
        </div>

        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Alt</label>
            <input name="alt" value="{{ old('alt', $item->alt) }}" class="form-control">
          </div>
          <div class="col-md-3">
            <label class="form-label">Sort Order</label>
            <input type="number" min="0" name="sort_order" value="{{ old('sort_order', $item->sort_order) }}" class="form-control">
          </div>
          <div class="col-md-3 d-flex align-items-end">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="is_active" value="1" {{ old('is_active', $item->is_active) ? 'checked' : '' }}>
              <label class="form-check-label">Active</label>
            </div>
          </div>
        </div>

        <div class="mt-4">
          <button class="btn btn-primary" type="submit">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
