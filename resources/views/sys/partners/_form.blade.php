@csrf

<div class="mb-3">
  <label class="form-label">Name</label>
  <input name="name" value="{{ old('name', $partner->name ?? '') }}"
    class="form-control @error('name') is-invalid @enderror">
  @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
  <label class="form-label">Website URL (optional)</label>
  <input name="url" value="{{ old('url', $partner->url ?? '') }}" class="form-control">
</div>

<div class="mb-3">
  <label class="form-label">Logo</label>
  <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror">
  @error('logo') <div class="invalid-feedback">{{ $message }}</div> @enderror

  @if(!empty($partner?->logo))
    <div class="mt-3">
      <img src="{{ asset(ltrim($partner->logo,'/')) }}" style="max-height:120px;object-fit:contain;border-radius:10px;">
      <div class="form-check mt-2">
        <input class="form-check-input" type="checkbox" name="remove_logo" value="1" id="rmLogo">
        <label class="form-check-label" for="rmLogo">Remove current logo</label>
      </div>
    </div>
  @endif
</div>

<div class="row">
  <div class="col-md-4 mb-3">
    <label class="form-label">Sort Order</label>
    <input type="number" min="0" name="sort_order" value="{{ old('sort_order', $partner->sort_order ?? 0) }}"
      class="form-control @error('sort_order') is-invalid @enderror">
    @error('sort_order') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  <div class="col-md-4 mb-3 d-flex align-items-end">
    <div class="form-check form-switch">
      <input class="form-check-input" type="checkbox" name="is_active" value="1" id="active"
        {{ old('is_active', $partner->is_active ?? true) ? 'checked' : '' }}>
      <label class="form-check-label" for="active">Active</label>
    </div>
  </div>
</div>

<button class="btn btn-success">{{ $buttonText ?? 'Save' }}</button>
<a href="{{ route('sys.partners.index') }}" class="btn btn-outline-secondary">Cancel</a>
