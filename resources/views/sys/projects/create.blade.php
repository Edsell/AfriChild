@extends('sys.layout')

@section('content')
<h4 class="mb-3">Create Project</h4>

<form method="POST" action="{{ route('sys.projects.store') }}" enctype="multipart/form-data">
  @csrf

  <div class="card mb-3">
    <div class="card-body">
      <div class="row g-3">


        <div class="col-md-6">
          <label class="form-label">Title *</label>
          <input class="form-control" name="title" value="{{ old('title') }}" required>
        </div>

       

        <div class="col-md-6">
          <label class="form-label">Excerpt</label>
          <input class="form-control" name="excerpt" value="{{ old('excerpt') }}" maxlength="255">
        </div>

        <div class="col-md-3">
          <label class="form-label">Sort Order</label>
          <input class="form-control" type="number" name="sort_order" value="{{ old('sort_order',0) }}">
        </div>

       <div class="col-md-3">
        <label class="form-label">Published At</label>
        @php $today = now()->format('Y-m-d'); @endphp
        <input class="form-control" type="date" name="published_at" value="{{ old('published_at', $today) }}">
      </div>

        <div class="col-md-6">
          <label class="form-label">Client</label>
          <input class="form-control" name="client" value="{{ old('client') }}">
        </div>

        <div class="col-md-6">
          <label class="form-label">Location</label>
          <input class="form-control" name="location" value="{{ old('location') }}">
        </div>

        <div class="col-md-3">
          <label class="form-label">Start Date</label>
          <input class="form-control" type="date" name="start_date" value="{{ old('start_date') }}">
        </div>

        <div class="col-md-3">
          <label class="form-label">End Date</label>
          <input class="form-control" type="date" name="end_date" value="{{ old('end_date') }}">
        </div>

        <div class="col-md-6">
          <label class="form-label">Cover Image</label>
          <input class="form-control" type="file" name="cover">
        </div>

        <div class="col-md-6">
        <label class="form-label">Gallery Images (multiple)</label>
        <input class="form-control" type="file" name="gallery_images[]" accept="image/*" multiple>
        <small class="text-muted">You can select multiple images.</small>
      </div>

       <div class="col-12">
        <label class="form-label">Description</label>
        <textarea id="project_description"
                  class="form-control"
                  name="description"
                  rows="6">{{ old('description') }}</textarea>
      </div>

        <div class="col-12 d-flex gap-4">
          <label><input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}> Featured</label>
          <label><input type="checkbox" name="is_active" value="1" {{ old('is_active',1) ? 'checked' : '' }}> Active</label>
        </div>

      </div>
    </div>
  </div>

  <button class="btn btn-primary">Save</button>
  <a class="btn btn-outline-secondary" href="{{ route('sys.projects.index') }}">Back</a>
</form>
@endsection


@push('styles')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.css">
@endpush

@push('scripts')
  {{-- only include jQuery here if your admin layout does NOT already include it --}}
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.js"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const $el = $('#project_description');
      if (!$el.length) return;

      $el.summernote({
        placeholder: 'Write the project description...',
        tabsize: 2,
        height: 260
      });
    });
  </script>
@endpush