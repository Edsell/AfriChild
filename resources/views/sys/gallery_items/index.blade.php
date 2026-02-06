@extends('sys.layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

  <div class="d-flex align-items-center justify-content-between mb-3">
    <div>
      <h4 class="mb-0">Images: {{ $gallery->name }}</h4>
      <div class="text-muted small">/uploads/galleries/{{ $gallery->id }}/</div>
    </div>
    <div class="d-flex gap-2">
      <a href="{{ route('sys.galleries.index') }}" class="btn btn-outline-secondary">Back</a>
      <a href="{{ route('sys.galleries.items.create', $gallery) }}" class="btn btn-primary">Upload Images</a>
    </div>
  </div>

 
  <div class="card">
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th style="width:90px;">Preview</th>
            <th>Alt</th>
            <th class="text-center">Sort</th>
            <th class="text-center">Active</th>
            <th class="text-end">Actions</th>
          </tr>
        </thead>
        <tbody id="sortableBody">
@forelse($items as $it)
  <tr data-id="{{ $it->id }}" style="cursor: grab;">
    <td>
      <img src="{{ asset($it->image) }}" alt="" style="width:70px;height:50px;object-fit:cover;border-radius:8px;">
    </td>

    {{-- INLINE ALT EDIT --}}
    <td style="min-width: 260px;">
      <input
        class="form-control form-control-sm js-alt"
        data-url="{{ route('sys.galleries.items.alt', [$gallery, $it]) }}"
        value="{{ $it->alt ?? '' }}"
        placeholder="Alt text (optional)"
      >
      <small class="text-muted d-none js-alt-saved">Saved</small>
    </td>

    <td class="text-center">
      <span class="badge bg-label-secondary">{{ $it->sort_order }}</span>
      <div class="text-muted small">Drag row to sort</div>
    </td>

    <td class="text-center">
      @if($it->is_active)
        <span class="badge bg-label-success">Yes</span>
      @else
        <span class="badge bg-label-secondary">No</span>
      @endif
    </td>

    <td class="text-end">
      <a class="btn btn-sm btn-outline-primary" href="{{ route('sys.galleries.items.edit', [$gallery, $it]) }}">Edit</a>
      <form class="d-inline" method="POST" action="{{ route('sys.galleries.items.destroy', [$gallery, $it]) }}"
            onsubmit="return confirm('Delete this image?')">
        @csrf @method('DELETE')
        <button class="btn btn-sm btn-outline-danger" type="submit">Delete</button>
      </form>
    </td>
  </tr>
@empty
  <tr><td colspan="5" class="text-center py-4 text-muted">No images yet.</td></tr>
@endforelse
</tbody>

      </table>
    </div>

    <div class="card-body">
      {{ $items->links() }}
    </div>
  </div>

</div>

@push('scripts')
  {{-- SortableJS (CDN) --}}
  <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>

  <script>
    const csrf = @json(csrf_token());

    // DRAG/DROP SORTING
    const tbody = document.getElementById('sortableBody');
    if (tbody) {
      new Sortable(tbody, {
        animation: 150,
        onEnd: async () => {
          const ids = [...tbody.querySelectorAll('tr[data-id]')].map(tr => Number(tr.dataset.id));
          try {
            const res = await fetch(@json(route('sys.galleries.items.order', $gallery)), {
              method: 'PATCH',
              headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf,
                'Accept': 'application/json',
              },
              body: JSON.stringify({ ids })
            });
            if (!res.ok) {
              console.error(await res.text());
              alert('Failed to update order.');
            }
          } catch (e) {
            console.error(e);
            alert('Failed to update order.');
          }
        }
      });
    }

    // INLINE ALT UPDATE (debounced)
    const debounce = (fn, ms=400) => {
      let t; return (...args) => { clearTimeout(t); t = setTimeout(() => fn(...args), ms); };
    };

    document.querySelectorAll('.js-alt').forEach((input) => {
      const saved = input.parentElement.querySelector('.js-alt-saved');

      const send = debounce(async () => {
        try {
          const res = await fetch(input.dataset.url, {
            method: 'PATCH',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': csrf,
              'Accept': 'application/json',
            },
            body: JSON.stringify({ alt: input.value })
          });

          if (res.ok) {
            saved.classList.remove('d-none');
            setTimeout(() => saved.classList.add('d-none'), 900);
          } else {
            console.error(await res.text());
          }
        } catch (e) {
          console.error(e);
        }
      }, 500);

      input.addEventListener('input', send);
    });
  </script>
@endpush


@endsection
