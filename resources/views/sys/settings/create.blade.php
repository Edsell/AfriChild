@extends('sys.layout')
@section('title', 'Create Settings')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="d-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-0">Create Settings</h4>
    <a href="{{ route('sys.settings.index') }}" class="btn btn-outline-secondary">Back</a>
  </div>

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
      </ul>
    </div>
  @endif

  <div class="card">
    <div class="card-body">
      <form method="POST" action="{{ route('sys.settings.store') }}" enctype="multipart/form-data">
        @csrf
        @include('sys.settings.partials.form', ['item' => null])

        <div class="mt-4">
          <button class="btn btn-primary" type="submit">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
