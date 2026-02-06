@extends('sys.layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="mb-3">Add Mission Item</h4>

  <div class="card">
    <div class="card-body">
      <form method="POST" action="{{ route('sys.mission.items.store', $mission) }}">
        @include('sys.mission.items._form', ['buttonText' => 'Create'])
      </form>
    </div>
  </div>
</div>
@endsection
