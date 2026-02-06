@csrf

<div class="mb-3">
  <label class="form-label">Title</label>
  <input type="text" name="title" value="{{ old('title', $item->title ?? '') }}"
         class="form-control @error('title') is-invalid @enderror">
  @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
  <label class="form-label">Description</label>
  <textarea name="description" rows="4"
    class="form-control @error('description') is-invalid @enderror">{{ old('description', $item->description ?? '') }}</textarea>
  @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="row">
  <div class="col-md-4 mb-3">
    <label class="form-label">Column</label>
    <select name="column" class="form-select @error('column') is-invalid @enderror">
      @php $col = old('column', $item->column ?? 'left'); @endphp
      <option value="left" {{ $col === 'left' ? 'selected' : '' }}>Left</option>
      <option value="right" {{ $col === 'right' ? 'selected' : '' }}>Right</option>
    </select>
    @error('column') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  <div class="col-md-4 mb-3">
    <label class="form-label">Icon (FontAwesome class)</label>
    <input type="text" name="icon" value="{{ old('icon', $item->icon ?? '') }}"
           placeholder="fa fa-star"
           class="form-control @error('icon') is-invalid @enderror">
    @error('icon') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  <div class="col-md-4 mb-3">
    <label class="form-label">Sort Order</label>
    <input type="number" name="sort_order" value="{{ old('sort_order', $item->sort_order ?? 0) }}"
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
<a href="{{ route('sys.mission.items.index', $mission) }}" class="btn btn-outline-secondary">Cancel</a>
