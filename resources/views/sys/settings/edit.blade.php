@extends('sys.layout')
@section('title', 'Edit Settings')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

  <div class="d-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-0">Edit Settings (#{{ $item->id }})</h4>
    <a href="{{ route('sys.settings.index') }}" class="btn btn-outline-secondary">Back</a>
  </div>

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
      </ul>
    </div>
  @endif

  <div class="row g-4">
    <div class="col-lg-7">
      <div class="card mb-4">
        <div class="card-header">
          <h5 class="mb-0">General Information</h5>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('sys.settings.update', $item) }}">
            @csrf @method('PUT')

            @include('sys.settings.partials.form', ['item' => $item])

            <div class="mt-4">
              <button class="btn btn-primary" type="submit">Update changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="col-lg-5">
      @include('sys.settings.partials.media', ['item' => $item])
    </div>
  </div>

</div>
@endsection
