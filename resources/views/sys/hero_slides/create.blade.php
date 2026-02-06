@extends('sys.layout')

@section('content')
<h4 class="mb-3">Create Hero Slide</h4>

<form method="POST" action="{{ route('sys.hero-slides.store') }}" enctype="multipart/form-data">
  @csrf

  <div class="card mb-3">
    <div class="card-body">
      <div class="row g-3">


        <div class="col-md-4"><label class="form-label">Kicker</label>
          <input class="form-control" name="kicker" value="{{ old('kicker') }}">
        </div>
        <div class="col-md-4"><label class="form-label">Title</label>
          <input class="form-control" name="title" value="{{ old('title') }}">
        </div>
        <div class="col-md-4"><label class="form-label">Subtitle</label>
          <input class="form-control" name="subtitle" value="{{ old('subtitle') }}">
        </div>

        <div class="col-md-6"><label class="form-label">Background Image</label>
          <input class="form-control" type="file" name="background">
        </div>
        <div class="col-md-6"><label class="form-label">Thumb (optional)</label>
          <input class="form-control" type="file" name="thumb">
        </div>

        <div class="col-md-4"><label class="form-label">Button Text</label>
          <input class="form-control" name="button_text" value="{{ old('button_text') }}">
        </div>
      <div class="col-md-4">
        <label class="form-label">Button Link</label>
        <select class="form-select" name="button_url">
          @foreach($links as $url => $label)
            <option value="{{ $url }}" {{ old('button_url') === $url ? 'selected' : '' }}>
              {{ $label }}
            </option>
          @endforeach
        </select>
        <small class="text-muted">Select where the slider button should go.</small>
      </div>
        {{-- <div class="col-md-4"><label class="form-label">Button BG</label>
          <input class="form-control" name="button_bg" value="{{ old('button_bg','#DB1E82') }}">
        </div> --}}

        <div class="col-md-4"><label class="form-label">Duration (ms)</label>
          <input class="form-control" type="number" name="duration_ms" value="{{ old('duration_ms',8970) }}">
        </div>

        <div class="col-12">
          <label class="form-label d-block">Status</label>
          <label><input type="checkbox" name="is_active" value="1" checked> Active</label>
        </div>
      </div>
    </div>
  </div>

  <button class="btn btn-primary">Save</button>
  <a class="btn btn-outline-secondary" href="{{ route('sys.hero-slides.index') }}">Back</a>
</form>
@endsection
