<div class="card mb-4">
  <div class="card-header">
    <h5 class="mb-0">Logo</h5>
    <small class="text-muted">This is the organization's logo</small>
  </div>
  <div class="card-body">
    @include('sys.settings.partials.update_logo', ['item' => $item])

    <div class="mt-3 p-2" style="background-color: rgba(132, 130, 130, 0.20); border-radius: 8px;">
      @if(!empty($item->Logo))
        <img src="{{ asset($item->Logo) }}" style="width:100%; height:auto;" alt="Logo">
      @else
        <div class="text-muted">No logo uploaded.</div>
      @endif
    </div>
  </div>
</div>

<div class="card">
  <div class="card-header">
    <h5 class="mb-0">Breadcrumb</h5>
    <small class="text-muted">This image appears at the top of each web page</small>
  </div>
  <div class="card-body">
    @include('sys.settings.partials.update_crumb', ['item' => $item])

    <div class="mt-3 p-2" style="background-color: rgba(132, 130, 130, 0.20); border-radius: 8px;">
      @if(!empty($item->Crumb))
        <img src="{{ asset($item->Crumb) }}" style="width:100%; height:auto;" alt="Breadcrumb">
      @else
        <div class="text-muted">No breadcrumb image uploaded.</div>
      @endif
    </div>
  </div>
</div>
