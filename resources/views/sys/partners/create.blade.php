@extends('sys.layout')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="mb-3">Add Partner</h4>
  <div class="card"><div class="card-body">
    <form method="POST" action="{{ route('sys.partners.store') }}" enctype="multipart/form-data">
      @include('sys.partners._form', ['buttonText' => 'Create'])
    </form>
  </div></div>
</div>
@endsection
