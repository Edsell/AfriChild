@csrf

<div class="mb-3">
  <label class="form-label">Title</label>
  <input type="text" name="title" value="{{ old('title', $item->title ?? '') }}"
    class="form-control @error('title') is-invalid @enderror">
  @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="row">
  <div class="col-md-6 mb-3">
    <label class="form-label">Percent (0-100)</label>
    <input type="number" name="percent" min="0" max="100"
      value="{{ old('percent', $item->percent ?? 50) }}"
      class="form-control @error('percent') is-invalid @enderror">
    @error('percent') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  <div class="col-md-6 mb-3">
    <label class="form-label">Sort Order</label>
    <input type="number" name="sort_order" min="0"
      value="{{ old('sort_order', $item->sort_order ?? 0) }}"
      class="form-control @error('sort_order') is-invalid @enderror">
    @error('sort_order') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>
</div>

<div class="form-check form-switch mb-3">
  <input class="form-check-input" type="checkbox" name="is_active" value="1" id="activeItem"
    {{ old('is_active', $item->is_active ?? true) ? 'checked' : '' }}>
  <label class="form-check-label" for="activeItem">Active</label>
</div>

<button class="btn btn-success">{{ $buttonText ?? 'Save' }}</button>
<a href="{{ route('sys.cta.items.index', $cta) }}" class="btn btn-outline-secondary">Cancel</a>
