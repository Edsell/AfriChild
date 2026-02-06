@extends('sys.layout')

@section('content')
<h4 class="mb-3">Edit Service</h4>

<form method="POST" action="{{ route('sys.services.update', $item) }}" enctype="multipart/form-data">
  @csrf @method('PUT')

  <div class="card mb-3">
    <div class="card-body">
      <div class="row g-3">

        <div class="col-md-6">
          <label class="form-label">Title *</label>
          <input class="form-control" name="title" value="{{ old('title',$item->title) }}" required>
        </div>

       <div class="col-md-6">
  <label class="form-label">Slug</label>
  <input class="form-control" value="{{ $item->slug }}" disabled>
</div>

        <div class="col-md-6">
          <label class="form-label">Icon Class</label>
          <input class="form-control" name="icon_class" value="{{ old('icon_class',$item->icon_class) }}" placeholder="e.g. fa fa-recycle">
          <small class="text-muted">Example: <code>fa fa-leaf</code></small>
        </div>

        <div class="col-md-6">
          <label class="form-label">Link URL (optional)</label>
          <input class="form-control" name="url" value="{{ old('url',$item->url) }}">
        </div>

        <div class="col-md-8">
          <label class="form-label">Excerpt</label>
          <input class="form-control" name="excerpt" value="{{ old('excerpt',$item->excerpt) }}" maxlength="255">
        </div>

        <div class="col-md-4">
          <label class="form-label">Sort Order</label>
          <input class="form-control" type="number" name="sort_order" value="{{ old('sort_order',$item->sort_order) }}">
        </div>

        <div class="col-md-6">
          <label class="form-label">Image (optional)</label>
          <input class="form-control" type="file" name="image" accept="image/*">

          @if($item->image)
            <small class="d-block mt-1">
              Current: <a href="{{ asset('uploads/'.$item->image) }}" target="_blank">view</a>
            </small>
          @endif
        </div>

        <div class="col-12">
          <label class="form-label">Description</label>
          <textarea class="form-control" name="description" rows="6">{{ old('description',$item->description) }}</textarea>
        </div>

        <div class="col-12"><hr class="my-1"></div>

        <div class="col-md-4">
          <label class="form-label">Meta Title</label>
          <input class="form-control" name="meta_title" value="{{ old('meta_title',$item->meta_title) }}">
        </div>

        <div class="col-md-4">
          <label class="form-label">Meta Keywords</label>
          <input class="form-control" name="meta_keywords" value="{{ old('meta_keywords',$item->meta_keywords) }}">
        </div>

        <div class="col-md-4">
          <label class="form-label">Meta Description</label>
          <input class="form-control" name="meta_description" value="{{ old('meta_description',$item->meta_description) }}">
        </div>

        <div class="col-12 d-flex gap-4 mt-2">
          <label>
            <input type="checkbox" name="is_active" value="1" {{ old('is_active',$item->is_active) ? 'checked' : '' }}>
            Active
          </label>
        </div>

      </div>
    </div>
  </div>

  <button class="btn btn-primary">Update</button>
  <a class="btn btn-outline-secondary" href="{{ route('sys.services.index') }}">Back</a>
</form>
@endsection
