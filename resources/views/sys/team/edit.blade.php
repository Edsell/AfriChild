@extends('sys.layout')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Edit Team Member</h4>
    <a href="{{ route('sys.team-members.index') }}" class="btn btn-outline-secondary">Back</a>
  </div>

  <div class="card"><div class="card-body">
    <form method="POST" action="{{ route('sys.team-members.update', $member) }}" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      @include('sys.team._form', [
        'buttonText' => 'Update',
        'member' => $member,
        'typeOptions' => $typeOptions
      ])
    </form>
  </div></div>
</div>
@endsection
