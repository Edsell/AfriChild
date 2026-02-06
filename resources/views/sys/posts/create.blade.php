@extends('sys.layout')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="mb-3">Add Blog Post</h4>
  <div class="card"><div class="card-body">
    <form method="POST" action="{{ route('sys.posts.store') }}" enctype="multipart/form-data">
    @include('sys.posts._form', ['buttonText' => 'Create'])
  </form>
  </div></div>
</div>
@endsection
