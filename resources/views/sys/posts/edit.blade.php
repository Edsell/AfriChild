@extends('sys.layout')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="mb-3">Edit Blog Post</h4>
  <div class="card"><div class="card-body">
    <form method="POST" action="{{ route('sys.posts.update', $post) }}" enctype="multipart/form-data">
      @csrf @method('PUT')
      @include('sys.posts._form', ['buttonText' => 'Update'])
    </form>
  </div></div>
</div>
@endsection
