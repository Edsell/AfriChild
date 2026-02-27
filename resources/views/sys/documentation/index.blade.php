@extends('sys.layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

  <div class="row g-3">
    {{-- LEFT --}}
    <div class="col-12 col-lg-4 col-xl-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center justify-content-between mb-3">
            <div class="d-flex align-items-center gap-2">
              <i class="bx bx-book-content fs-4 text-primary"></i>
              <div class="fw-semibold">Documentation</div>
            </div>
            <span class="badge bg-label-primary">v1.0</span>
          </div>

          <div class="mb-2">
            <div class="text-muted small mb-1">Search (page)</div>
            <input id="docSearchInput" class="form-control" placeholder="Search this page..." />
            <div class="text-muted small mt-2">Tip: use Ctrl/⌘ + F too.</div>
          </div>

          <div class="list-group mt-3" id="docNav">
            @foreach($menu as $item)
              <a href="#"
                 class="list-group-item list-group-item-action d-flex align-items-center gap-2 doc-link"
                 data-key="{{ $item['key'] }}">
                <i class="{{ $item['icon'] }}"></i>
                <span>{{ $item['label'] }}</span>
              </a>

              @if(!empty($item['children']))
                @foreach($item['children'] as $child)
                  <a href="#"
                     class="list-group-item list-group-item-action ps-5 d-flex align-items-center gap-2 doc-link"
                     data-key="{{ $child['key'] }}">
                    <i class="{{ $child['icon'] }}"></i>
                    <span>{{ $child['label'] }}</span>
                  </a>
                @endforeach
              @endif
            @endforeach
          </div>

        </div>
      </div>
    </div>

    {{-- RIGHT --}}
    <div class="col-12 col-lg-8 col-xl-9">
      <div class="card">
        <div class="card-body">

          <div class="d-flex flex-wrap align-items-start justify-content-between gap-2">
            <div>
              <h5 class="mb-1">AfriChild MIS — User Guide</h5>
              <div class="text-muted">Use the left menu to open a guide. The content loads here.</div>
            </div>
            <span class="badge bg-label-primary">Updated: {{ date('M d, Y') }}</span>
          </div>

          <hr class="my-3" />

          <div id="docContent">
            <div class="text-muted">Loading…</div>
          </div>

        </div>
      </div>
    </div>
  </div>

</div>
@endsection

@push('styles')
<style>
  .doc-active {
    background: rgba(105,108,255,.12) !important;
    border-color: rgba(105,108,255,.25) !important;
    color: #696cff !important;
  }
</style>
@endpush

@push('scripts')
<script>
(function () {
  const content = document.getElementById('docContent');
  const links = Array.from(document.querySelectorAll('.doc-link'));
  const search = document.getElementById('docSearchInput');

  function setActive(key) {
    links.forEach(a => a.classList.toggle('doc-active', a.dataset.key === key));
  }

  async function loadSection(key, pushState = true) {
    setActive(key);
    content.innerHTML = `<div class="text-muted">Loading…</div>`;

    const url = `{{ route('sys.documentation.section', '__KEY__') }}`.replace('__KEY__', encodeURIComponent(key));

    try {
      const res = await fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
      if (!res.ok) throw new Error('Failed');
      const html = await res.text();
      content.innerHTML = html;

      // update URL (so refresh keeps section)
      if (pushState) {
        const u = new URL(window.location.href);
        u.searchParams.set('k', key);
        history.pushState({ key }, '', u.toString());
      }

      // reset page-search input because new content loaded
      if (search) search.value = '';

    } catch (e) {
      content.innerHTML = `
        <div class="alert alert-danger mb-0">
          Could not load documentation section. Please try again.
        </div>`;
    }
  }

  // Click handlers
  links.forEach(a => {
    a.addEventListener('click', (e) => {
      e.preventDefault();
      loadSection(a.dataset.key);
    });
  });

  // Handle back/forward
  window.addEventListener('popstate', (ev) => {
    const key = (ev.state && ev.state.key) || (new URL(window.location.href)).searchParams.get('k') || 'overview';
    loadSection(key, false);
  });

  // Simple in-page highlight search (current loaded content only)
  function clearMarks(root) {
    root.querySelectorAll('mark.doc-mark').forEach(m => {
      const txt = document.createTextNode(m.textContent);
      m.parentNode.replaceChild(txt, m);
    });
  }

  function highlight(root, q) {
    if (!q) return;
    const walker = document.createTreeWalker(root, NodeFilter.SHOW_TEXT, null);
    const nodes = [];
    while (walker.nextNode()) nodes.push(walker.currentNode);

    nodes.forEach(n => {
      const text = n.nodeValue;
      const idx = text.toLowerCase().indexOf(q.toLowerCase());
      if (idx < 0) return;

      const span = document.createElement('span');
      span.innerHTML =
        text.slice(0, idx) +
        `<mark class="doc-mark">${text.slice(idx, idx + q.length)}</mark>` +
        text.slice(idx + q.length);

      n.parentNode.replaceChild(span, n);
    });
  }

  if (search) {
    search.addEventListener('input', () => {
      if (!content) return;
      clearMarks(content);
      const q = search.value.trim();
      if (!q) return;
      highlight(content, q);
      const first = content.querySelector('mark.doc-mark');
      if (first) first.scrollIntoView({ behavior: 'smooth', block: 'center' });
    });
  }

  // Initial load
  loadSection(@json($defaultKey), false);
  setActive(@json($defaultKey));
})();
</script>
@endpush