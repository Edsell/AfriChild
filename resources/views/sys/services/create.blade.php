@extends('sys.layout')

@section('content')
<h4 class="mb-3">Create Service</h4>

<form method="POST" action="{{ route('sys.services.store') }}" enctype="multipart/form-data">
  @csrf

  <div class="card mb-3">
    <div class="card-body">
      <div class="row g-3">

       <div class="col-md-6">
        <label class="form-label">Title *</label>
        <input class="form-control" name="title" value="{{ old('title') }}" required>
        </div>

        <div class="col-md-6">
        <label class="form-label">Icon Class</label>
        <input class="form-control" name="icon_class" value="{{ old('icon_class','fa fa-leaf') }}" placeholder="e.g. fa fa-recycle">
        </div>


       

        <div class="col-md-8">
          <label class="form-label">Excerpt</label>
          <input class="form-control" name="excerpt" value="{{ old('excerpt') }}" maxlength="255" placeholder="Short summary shown on home cards">
        </div>

        <div class="col-md-4">
          <label class="form-label">Sort Order</label>
          <input class="form-control" type="number" name="sort_order" value="{{ old('sort_order',0) }}">
        </div>

        <div class="col-md-6">
          <label class="form-label">Image (optional)</label>
          <input class="form-control" type="file" name="image" accept="image/*">
          <small class="text-muted">Uploads to <code>public/uploads/services</code></small>
        </div>

        <div class="col-12">
          <label class="form-label">Description</label>
          <textarea class="form-control" name="description" rows="6" placeholder="Full description (optional)">{{ old('description') }}</textarea>
        </div>

        <div class="col-12"><hr class="my-1"></div>

        <div class="col-md-4">
          <label class="form-label">Meta Title</label>
          <input class="form-control" name="meta_title" value="{{ old('meta_title') }}">
        </div>

        <div class="col-md-4">
          <label class="form-label">Meta Keywords</label>
          <input class="form-control" name="meta_keywords" value="{{ old('meta_keywords') }}">
        </div>

        <div class="col-md-4">
          <label class="form-label">Meta Description</label>
          <input class="form-control" name="meta_description" value="{{ old('meta_description') }}">
        </div>

        <div class="col-12 d-flex gap-4 mt-2">
          <label>
            <input type="checkbox" name="is_active" value="1" {{ old('is_active',1) ? 'checked' : '' }}>
            Active
          </label>
        </div>

      </div>
    </div>
  </div>

  <button class="btn btn-primary">Save</button>
  <a class="btn btn-outline-secondary" href="{{ route('sys.services.index') }}">Back</a>
</form>
@endsection
