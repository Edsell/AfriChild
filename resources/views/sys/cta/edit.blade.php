@extends('sys.layout')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">CTA Section</h4>
    <a href="{{ route('sys.cta.items.index', $section) }}" class="btn btn-primary">
      Manage CTA Items
    </a>
  </div>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="card">
    <div class="card-body">
      <form method="POST" action="{{ route('sys.cta.update', $section) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
          <label class="form-label">Parallax Speed</label>
          <input type="number" step="0.1" name="parallax_speed"
            value="{{ old('parallax_speed', $section->parallax_speed) }}"
            class="form-control @error('parallax_speed') is-invalid @enderror">
          @error('parallax_speed') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
          <label class="form-label">Background Image</label>
          <input type="file" name="background_image"
            class="form-control @error('background_image') is-invalid @enderror">
          @error('background_image') <div class="invalid-feedback">{{ $message }}</div> @enderror

          @if($section->background_image)
            <div class="mt-3">
              <img src="{{ asset($section->background_image) }}" alt="" style="max-height:120px;border-radius:8px;">
              <div class="form-check mt-2">
                <input class="form-check-input" type="checkbox" name="remove_background_image" value="1" id="removeBg">
                <label class="form-check-label" for="removeBg">Remove current image</label>
              </div>
            </div>
          @endif
        </div>

        <div class="form-check form-switch mb-3">
          <input class="form-check-input" type="checkbox" name="is_active" value="1" id="active"
            {{ old('is_active', $section->is_active) ? 'checked' : '' }}>
          <label class="form-check-label" for="active">Active</label>
        </div>

        <button class="btn btn-success">Save Changes</button>
      </form>
    </div>
  </div>

</div>
@endsection
