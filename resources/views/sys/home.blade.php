@extends('sys_views.layout')

@section('content')
@include('sys_views.breadcrumbs', ['title' => 'Home'])

<form method="POST" action="{{ route('sys.home.update') }}">
  @csrf @method('PUT')

  <div class="card mb-3">
    <div class="card-body">
      <label class="form-label">Page Title</label>
      <input class="form-control" name="title" value="{{ old('title', $page->title) }}">
    </div>
  </div>

  <div class="card">
    <div class="card-body">
      <h5>Hero Section</h5>
      <div class="mb-3">
        <label class="form-label">Hero Title</label>
        <input class="form-control" name="content[hero_title]"
          value="{{ old('content.hero_title', $page->content['hero_title'] ?? '') }}">
      </div>

      <div class="mb-3">
        <label class="form-label">Hero Subtitle</label>
        <input class="form-control" name="content[hero_subtitle]"
          value="{{ old('content.hero_subtitle', $page->content['hero_subtitle'] ?? '') }}">
      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label">Button Text</label>
          <input class="form-control" name="content[hero_button_text]"
            value="{{ $page->content['hero_button_text'] ?? '' }}">
        </div>
        <div class="col-md-6 mb-3">
          <label class="form-label">Button Link</label>
          <input class="form-control" name="content[hero_button_link]"
            value="{{ $page->content['hero_button_link'] ?? '' }}">
        </div>
      </div>

      <button class="btn btn-primary">Save</button>
    </div>
  </div>
</form>
@endsection
