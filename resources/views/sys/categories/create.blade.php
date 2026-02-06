@extends('sys.layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Add Category</h4>
    <a class="btn btn-outline-secondary" href="{{ route('sys.categories.index') }}">Back</a>
  </div>

  <div class="card">
    <div class="card-body">
      <form method="POST" action="{{ route('sys.categories.store') }}">
        @include('sys.categories._form', ['buttonText' => 'Create'])
      </form>
    </div>
  </div>
</div>
@endsection
