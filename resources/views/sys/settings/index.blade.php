@extends('sys.layout') {{-- adjust to your admin layout --}}
@section('title', 'General Settings')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

  <div class="d-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-0">General Settings</h4>
    <a href="{{ route('sys.settings.create') }}" class="btn btn-primary">
      <i class="bx bx-plus"></i> New Settings
    </a>
  </div>


  <div class="card">
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Organization</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Country</th>
            <th>Currency</th>
            <th class="text-end">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($items as $row)
            <tr>
              <td>{{ $row->id }}</td>
              <td>{{ $row->CompanyName }}</td>
              <td>{{ $row->Email }}</td>
              <td>{{ trim(($row->Code ? $row->Code.' ' : '').($row->Phone ?? '')) }}</td>
              <td>{{ $row->Country }}</td>
              <td>{{ $row->Currency }}</td>
              <td class="text-end">
                <a class="btn btn-sm btn-outline-primary" href="{{ route('sys.settings.edit', $row) }}">
                  <i class="bx bx-edit"></i>
                </a>

                <form class="d-inline" method="POST" action="{{ route('sys.settings.destroy', $row) }}"
                      onsubmit="return confirm('Delete this settings record?');">
                  @csrf @method('DELETE')
                  <button class="btn btn-sm btn-outline-danger" type="submit">
                    <i class="bx bx-trash"></i>
                  </button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" class="text-center py-4">No settings found.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="card-body">
      {{ $items->links() }}
    </div>
  </div>

</div>
@endsection
