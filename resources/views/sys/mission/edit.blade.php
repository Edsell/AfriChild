@extends('sys.layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Mission Section</h4>
    <a href="{{ route('sys.mission.items.index', $section) }}" class="btn btn-primary">
      Manage Mission Items
    </a>
  </div>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="card">
    <div class="card-body">
      <form method="POST" action="{{ route('sys.mission.update', $section) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
          <label class="form-label">Title</label>
          <input type="text" name="title" value="{{ old('title', $section->title) }}"
                 class="form-control @error('title') is-invalid @enderror">
          @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
          <label class="form-label">Center Image</label>
          <input type="file" name="center_image"
                 class="form-control @error('center_image') is-invalid @enderror">
          @error('center_image') <div class="invalid-feedback">{{ $message }}</div> @enderror

          @if($section->center_image)
            <div class="mt-3">
              <img src="{{ asset($section->center_image) }}" alt="" style="max-height:120px;border-radius:8px;">
              <div class="form-check mt-2">
                <input class="form-check-input" type="checkbox" name="remove_center_image" value="1" id="removeImg">
                <label class="form-check-label" for="removeImg">Remove current image</label>
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
