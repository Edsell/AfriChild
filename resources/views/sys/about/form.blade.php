@extends('sys.layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

  <div class="d-flex align-items-center justify-content-between mb-3">
    <h4 class="mb-0">{{ $item->exists ? 'Edit About' : 'Create About' }}</h4>
    <a href="{{ route('sys.about.index') }}" class="btn btn-outline-secondary">Back</a>
  </div>

 

  <form class="card" method="POST"
        action="{{ $item->exists ? route('sys.about.update', $item) : route('sys.about.store') }}"
        enctype="multipart/form-data">
    @csrf
    @if($item->exists) @method('PUT') @endif

    <div class="card-body">
      <div class="row g-3">

        <div class="col-md-6">
          <label class="form-label">Page Title</label>
          <input type="text" name="page_title" class="form-control"
                 value="{{ old('page_title', $item->page_title) }}" required>
        </div>

        <div class="col-md-6">
          <label class="form-label">Heading</label>
          <input type="text" name="heading" class="form-control"
                 value="{{ old('heading', $item->heading) }}"
                 placeholder="e.g. About AfriChild">
        </div>

        <div class="col-12">
          <label class="form-label">Content</label>
         <textarea id="about_content"
          name="content"
          class="form-control"
          rows="8"
          placeholder="Main about text...">{{ old('content', $item->content) }}</textarea>
        </div>

        <div class="col-md-6">
          <label class="form-label">CTA Text</label>
          <input type="text" name="cta_text" class="form-control"
                 value="{{ old('cta_text', $item->cta_text) }}"
                 placeholder="e.g. Join Now">
        </div>

        <div class="col-md-6">
          <label class="form-label">CTA URL</label>
          <input type="text" name="cta_url" class="form-control"
                 value="{{ old('cta_url', $item->cta_url) }}"
                 placeholder="e.g. {{ url('/contact') }}">
        </div>

        <div class="col-md-6">
          <label class="form-label">Image</label>
          <input type="file" name="image_file" class="form-control">
          @if(!empty($item->image))
            <div class="mt-2">
              <img src="{{ asset('storage/' . ltrim($item->image, '/')) }}" alt=""
                   style="max-height:120px;border-radius:8px;">
            </div>
          @endif
        </div>

        <div class="col-md-6 d-flex align-items-end">
          <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="is_active"
                   name="is_active" value="1"
                   {{ old('is_active', $item->is_active) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active">Active</label>
          </div>
        </div>

        <hr class="my-2">

        <div class="col-md-6">
          <label class="form-label">Meta Title</label>
          <input type="text" name="meta_title" class="form-control"
                 value="{{ old('meta_title', $item->meta_title) }}">
        </div>

        <div class="col-md-6">
          <label class="form-label">Meta Description</label>
          <input type="text" name="meta_description" class="form-control"
                 value="{{ old('meta_description', $item->meta_description) }}">
        </div>

      </div>
    </div>

    <div class="card-footer d-flex justify-content-end gap-2">
      <button class="btn btn-primary" type="submit">Save</button>
    </div>
  </form>

</div>
@endsection


@push('styles')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.css">
@endpush

@push('scripts')
  {{-- Only include jQuery here if your admin layout doesn’t already include it --}}
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.js"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const $el = $('#about_content');
      if (!$el.length) return;

      $el.summernote({
        placeholder: 'Main about text...',
        tabsize: 2,
        height: 260
      });
    });
  </script>
@endpush