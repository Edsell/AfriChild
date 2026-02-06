@extends('sys.layout')

@section('content')
<h4 class="mb-3">Edit Home Page Settings</h4>

<form method="POST" action="{{ route('sys.home-pages.update', $item) }}">
  @csrf @method('PUT')

  <div class="card mb-3">
    <div class="card-body">
      <div class="row g-3">
        <div class="col-md-6">
          <label class="form-label">Title</label>
          <input class="form-control" name="title" value="{{ old('title',$item->title) }}">
        </div>
        <div class="col-md-6">
          <label class="form-label">Slug</label>
          <input class="form-control" name="slug" value="{{ old('slug',$item->slug) }}" required>
        </div>

        <div class="col-12"><hr></div>

        <div class="col-md-4"><label class="form-label">Services Title</label>
          <input class="form-control" name="services_title" value="{{ old('services_title',$item->services_title) }}">
        </div>
        <div class="col-md-4"><label class="form-label">Projects Title</label>
          <input class="form-control" name="projects_title" value="{{ old('projects_title',$item->projects_title) }}">
        </div>
        <div class="col-md-4"><label class="form-label">Hero Title</label>
          <input class="form-control" name="hero_title" value="{{ old('hero_title',$item->hero_title) }}">
        </div>

        <div class="col-12 d-flex gap-4 mt-2">
          <label><input type="checkbox" name="show_hero" value="1" {{ $item->show_hero ? 'checked' : '' }}> Show Hero</label>
          <label><input type="checkbox" name="show_services" value="1" {{ $item->show_services ? 'checked' : '' }}> Show Services</label>
          <label><input type="checkbox" name="show_projects" value="1" {{ $item->show_projects ? 'checked' : '' }}> Show Projects</label>
          <label><input type="checkbox" name="is_active" value="1" {{ $item->is_active ? 'checked' : '' }}> Active</label>
        </div>
      </div>
    </div>
  </div>

  <button class="btn btn-primary">Update</button>
  <a class="btn btn-outline-secondary" href="{{ route('sys.home-pages.index') }}">Back</a>
</form>
@endsection
