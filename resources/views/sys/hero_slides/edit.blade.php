@extends('sys.layout')

@section('content')
<h4 class="mb-3">Edit Hero Slide</h4>

<form method="POST" action="{{ route('sys.hero-slides.update',$item) }}" enctype="multipart/form-data">
  @csrf @method('PUT')

  <div class="card mb-3">
    <div class="card-body">
      <div class="row g-3">
        
        <div class="col-md-6">
          <label class="form-label">Sort Order</label>
          <input class="form-control" type="number" name="sort_order" value="{{ old('sort_order',$item->sort_order) }}">
        </div>

        <div class="col-md-4"><label class="form-label">Kicker</label>
          <input class="form-control" name="kicker" value="{{ old('kicker',$item->kicker) }}">
        </div>
        <div class="col-md-4"><label class="form-label">Title</label>
          <input class="form-control" name="title" value="{{ old('title',$item->title) }}">
        </div>
        <div class="col-md-4"><label class="form-label">Subtitle</label>
          <input class="form-control" name="subtitle" value="{{ old('subtitle',$item->subtitle) }}">
        </div>

        <div class="col-md-6">
          <label class="form-label">Background Image</label>
          <input class="form-control" type="file" name="background">
          @if($item->background)
            <small class="d-block mt-1">Current: <a href="{{ asset('uploads/'.$item->background) }}" target="_blank">view</a></small>
          @endif
        </div>

        <div class="col-md-6">
          <label class="form-label">Thumb</label>
          <input class="form-control" type="file" name="thumb">
          @if($item->thumb)
            <small class="d-block mt-1">Current: <a href="{{ asset('uploads/'.$item->thumb) }}" target="_blank">view</a></small>
          @endif
        </div>

        <div class="col-md-4"><label class="form-label">Button Text</label>
          <input class="form-control" name="button_text" value="{{ old('button_text',$item->button_text) }}">
        </div>
        <div class="col-md-4">
        <label class="form-label">Button Link</label>
        <select class="form-select" name="button_url">
          @foreach($links as $url => $label)
            <option value="{{ $url }}" {{ old('button_url', $item->button_url) === $url ? 'selected' : '' }}>
              {{ $label }}
            </option>
          @endforeach
        </select>
      </div>

        {{-- <div class="col-md-4"><label class="form-label">Button BG</label>
          <input class="form-control" name="button_bg" value="{{ old('button_bg',$item->button_bg) }}">
        </div> --}}

        <div class="col-md-4"><label class="form-label">Duration (ms)</label>
          <input class="form-control" type="number" name="duration_ms" value="{{ old('duration_ms',$item->duration_ms) }}">
        </div>

        <div class="col-12">
          <label class="form-label d-block">Status</label>
          <label><input type="checkbox" name="is_active" value="1" {{ $item->is_active ? 'checked' : '' }}> Active</label>
        </div>
      </div>
    </div>
  </div>

  <button class="btn btn-primary">Update</button>
  <a class="btn btn-outline-secondary" href="{{ route('sys.hero-slides.index') }}">Back</a>
</form>
@endsection
