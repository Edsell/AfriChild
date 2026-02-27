@extends('sys.layout') 
@section('title', $event->exists ? 'Edit Event' : 'Add Event')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

  <div class="d-flex align-items-center justify-content-between mb-3">
    <h4 class="mb-0">{{ $event->exists ? 'Edit Event' : 'Add Event' }}</h4>
    <a href="{{ route('sys.events.index') }}" class="btn btn-outline-secondary">Back</a>
  </div>


  <form method="POST"
        action="{{ $event->exists ? route('sys.events.update',$event) : route('sys.events.store') }}"
        enctype="multipart/form-data"
        class="card">
    @csrf
    @if($event->exists) @method('PUT') @endif

    <div class="card-body">
      <div class="row g-3">
        <div class="col-md-8">
          <label class="form-label">Title</label>
          <input name="title" value="{{ old('title',$event->title) }}" class="form-control" required>
        </div>

        <div class="col-md-4">
          <label class="form-label">Status</label>
          <select name="status" class="form-select" required>
            <option value="published" @selected(old('status',$event->status)==='published')>Published</option>
            <option value="draft" @selected(old('status',$event->status)==='draft')>Draft</option>
          </select>
        </div>

        <div class="col-md-6">
          <label class="form-label">Event Date</label>
          <input type="date" name="event_date" value="{{ old('event_date', optional($event->event_date)->format('Y-m-d')) }}"
                 class="form-control" required>
        </div>

        <div class="col-md-6">
          <label class="form-label">Event Time (HH:MM)</label>
          <input type="time" name="event_time" value="{{ old('event_time',$event->event_time) }}"
                 class="form-control">
        </div>

        <div class="col-md-6">
          <label class="form-label">Venue</label>
          <input name="venue" value="{{ old('venue',$event->venue) }}" class="form-control">
        </div>

        <div class="col-md-6">
          <label class="form-label">Location</label>
          <input name="location" value="{{ old('location',$event->location) }}" class="form-control">
        </div>

        <div class="col-md-8">
          <label class="form-label">Excerpt</label>
          <input name="excerpt" value="{{ old('excerpt',$event->excerpt) }}" class="form-control" maxlength="255">
        </div>

        <div class="col-md-4">
          <label class="form-label">Sort Order</label>
          <input type="number" name="sort_order" value="{{ old('sort_order',$event->sort_order ?? 0) }}"
                 class="form-control" min="0">
        </div>

        <div class="col-md-12">
          <label class="form-label">Description</label>
         <textarea id="event_description"
          name="description"
          rows="6"
          class="form-control">{{ old('description',$event->description) }}</textarea>
        </div>

        <div class="col-md-6">
          <label class="form-label">Image (square works best)</label>
          <input type="file" name="image" class="form-control" accept="image/*">
          <small class="text-muted">Max 4MB. jpg, png, webp</small>
        </div>

        <div class="col-md-6 d-flex align-items-end gap-3">
          <div class="form-check mt-3">
            <input class="form-check-input" type="checkbox" name="is_featured" value="1"
                   @checked(old('is_featured',$event->is_featured))>
            <label class="form-check-label">Featured</label>
          </div>

          @if($event->exists)
            <div class="form-check mt-3">
              <input class="form-check-input" type="checkbox" name="regenerate_slug" value="1">
              <label class="form-check-label">Regenerate slug</label>
            </div>
          @endif
        </div>

        @if($event->exists)
          <div class="col-md-12">
            <div class="d-flex align-items-center gap-2">
              <img src="{{ $event->image_url }}" class="rounded" style="width:72px;height:72px;object-fit:cover" alt="">
              <div class="text-muted">Current image</div>
            </div>
          </div>
        @endif
      </div>
    </div>

    <div class="card-footer d-flex justify-content-end gap-2">
      <button class="btn btn-primary">{{ $event->exists ? 'Update' : 'Create' }}</button>
      <a href="{{ route('sys.events.index') }}" class="btn btn-outline-secondary">Cancel</a>
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
      const $el = $('#event_description');
      if (!$el.length) return;

      $el.summernote({
        placeholder: 'Write the event description...',
        tabsize: 2,
        height: 260
      });
    });
  </script>
@endpush