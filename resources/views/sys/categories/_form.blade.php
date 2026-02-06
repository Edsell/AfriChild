@csrf

@php
  $category = $category ?? null;
@endphp

<div class="mb-3">
  <label class="form-label">Name</label>
  <input name="name" value="{{ old('name', $category->name ?? '') }}"
         class="form-control @error('name') is-invalid @enderror">
  @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
{{-- 
<div class="mb-3">
  <label class="form-label">Slug (optional)</label>
  <input name="slug" value="{{ old('slug', $category->slug ?? '') }}"
         class="form-control @error('slug') is-invalid @enderror">
  @error('slug') <div class="invalid-feedback">{{ $message }}</div> @enderror
  <div class="form-text">Leave blank to auto-generate from name.</div>
</div> --}}

<hr class="my-3">

<h6 class="mb-3">SEO (optional)</h6>

<div class="mb-3">
  <label class="form-label">Meta Title</label>
  <input name="meta_title" value="{{ old('meta_title', $category->meta_title ?? '') }}"
         class="form-control @error('meta_title') is-invalid @enderror">
  @error('meta_title') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
  <label class="form-label">Meta Description</label>
  <textarea name="meta_description" rows="2"
            class="form-control @error('meta_description') is-invalid @enderror">{{ old('meta_description', $category->meta_description ?? '') }}</textarea>
  @error('meta_description') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
  <label class="form-label">Meta Keywords</label>
  <input name="meta_keywords" value="{{ old('meta_keywords', $category->meta_keywords ?? '') }}"
         class="form-control @error('meta_keywords') is-invalid @enderror">
  @error('meta_keywords') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<button class="btn btn-primary">{{ $buttonText ?? 'Save' }}</button>
<a href="{{ route('sys.categories.index') }}" class="btn btn-outline-secondary">Cancel</a>
