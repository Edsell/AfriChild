
@csrf

@php
  // Ensure $post always exists
  $post = $post ?? null;

  // expected from controller:
  // $categories, $tags
  $categories = $categories ?? collect();
  $tags = $tags ?? collect();

  // edit selections (optional)
  $selectedCategoryIds = $selectedCategoryIds ?? ($post?->categories?->pluck('id')->all() ?? []);
  $selectedTagIds      = $selectedTagIds ?? ($post?->tags?->pluck('id')->all() ?? []);

  $oldCategoryIds = old('category_ids', $selectedCategoryIds);
  $oldTagIds      = old('tag_ids', $selectedTagIds);

  $oldNewTags = old('new_tags', '');
@endphp

<div class="mb-3">
  <label class="form-label">Title</label>
  <input name="title" value="{{ old('title', $post->title ?? '') }}"
    class="form-control @error('title') is-invalid @enderror">
  @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
  <label class="form-label">Slug (optional)</label>
  <input name="slug" value="{{ old('slug', $post->slug ?? '') }}"
    class="form-control @error('slug') is-invalid @enderror">
  @error('slug') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="row">
  <div class="col-md-6 mb-3">
    <label class="form-label">Author Name</label>
    <input name="author_name" value="{{ old('author_name', $post->author_name ?? '') }}" class="form-control">
  </div>
  <div class="col-md-3 mb-3">
    <label class="form-label">Sort Order</label>
    <input type="number" min="0" name="sort_order"
      value="{{ old('sort_order', $post->sort_order ?? 0) }}"
      class="form-control @error('sort_order') is-invalid @enderror">
    @error('sort_order') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>
  <div class="col-md-3 mb-3 d-flex align-items-end">
    <div class="form-check form-switch">
      <input class="form-check-input" type="checkbox" name="is_published" value="1" id="pub"
        {{ old('is_published', $post->is_published ?? false) ? 'checked' : '' }}>
      <label class="form-check-label" for="pub">Published</label>
    </div>
  </div>
</div>

<div class="mb-3">
  <label class="form-label">Published At (optional)</label>
  <input type="date" name="published_at"
    value="{{ old('published_at', !empty($post?->published_at) ? $post->published_at->format('Y-m-d') : '' ) }}"
    class="form-control @error('published_at') is-invalid @enderror">
  @error('published_at') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

{{-- Categories + Tags --}}
<div class="row">
  {{-- Categories --}}
  <div class="col-lg-6 mb-3">
    <div class="card border">
      <div class="card-header bg-transparent d-flex align-items-center justify-content-between">
        <span class="fw-semibold">Categories</span>
        <small class="text-muted">Select one or more</small>
      </div>

      <div class="card-body">
        @error('category_ids') <div class="text-danger small mb-2">{{ $message }}</div> @enderror

        @if($categories->count())
          <div class="row g-2">
            @foreach($categories as $cat)
              @php $checked = in_array($cat->id, (array)$oldCategoryIds); @endphp
              <div class="col-12 col-md-6">
                <label class="d-flex align-items-center gap-2 p-2 border rounded">
                  <input class="form-check-input m-0"
                         type="checkbox"
                         name="category_ids[]"
                         value="{{ $cat->id }}"
                         {{ $checked ? 'checked' : '' }}>
                  <span class="small fw-semibold">{{ $cat->name }}</span>
                </label>
              </div>
            @endforeach
          </div>
        @else
          <div class="text-muted small">No categories yet. Create categories first.</div>
        @endif
      </div>
    </div>
  </div>

  {{-- Tags --}}
  <div class="col-lg-6 mb-3">
    <div class="card border">
      <div class="card-header bg-transparent d-flex align-items-center justify-content-between">
        <span class="fw-semibold">Tags</span>
        <small class="text-muted">Select existing + add new</small>
      </div>

      <div class="card-body">
        <label class="form-label">Choose existing tags</label>
        <select name="tag_ids[]" class="form-select" multiple size="7">
          @forelse($tags as $tag)
            <option value="{{ $tag->id }}" {{ in_array($tag->id, (array)$oldTagIds) ? 'selected' : '' }}>
              {{ $tag->name }}
            </option>
          @empty
            <option disabled>No tags yet</option>
          @endforelse
        </select>

        <div class="mt-3">
          <label class="form-label">Add new tags (comma separated)</label>
          <input type="text"
                 name="new_tags"
                 value="{{ $oldNewTags }}"
                 class="form-control"
                 placeholder="e.g. Research, Policy, Child Wellbeing">
          <div class="form-text">New tags will be created and attached on save.</div>
        </div>

        {{-- Convert new_tags -> tag_names[] (controller expects tag_names[]) --}}
        <script>
          (function () {
            const form = document.currentScript.closest('form');
            if (!form) return;

            form.addEventListener('submit', function () {
              form.querySelectorAll('input[name="tag_names[]"]').forEach(el => el.remove());

              const input = form.querySelector('input[name="new_tags"]');
              if (!input) return;

              const raw = (input.value || '').trim();
              if (!raw) return;

              raw.split(',')
                .map(s => s.trim())
                .filter(Boolean)
                .forEach(name => {
                  const hidden = document.createElement('input');
                  hidden.type = 'hidden';
                  hidden.name = 'tag_names[]';
                  hidden.value = name;
                  form.appendChild(hidden);
                });
            });
          })();
        </script>
      </div>
    </div>
  </div>
</div>

<div class="mb-3">
  <label class="form-label">Excerpt</label>
  <textarea name="excerpt" rows="2" class="form-control @error('excerpt') is-invalid @enderror">{{ old('excerpt', $post->excerpt ?? '') }}</textarea>
  @error('excerpt') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
  <label class="form-label">Content</label>

  <textarea id="content_editor"
            name="content"
            rows="10"
            class="form-control @error('content') is-invalid @enderror">{{ old('content', $post->content ?? '') }}</textarea>

  @error('content') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
  <label class="form-label">Featured Image</label>
  <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
  @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror

  @if(!empty($post?->image))
    <div class="mt-3">
      <img src="{{ asset($post->image) }}" style="max-height:120px;border-radius:10px;">
      <div class="form-check mt-2">
        <input class="form-check-input" type="checkbox" name="remove_image" value="1" id="rm">
        <label class="form-check-label" for="rm">Remove current image</label>
      </div>
    </div>
  @endif
</div>

<button class="btn btn-success">{{ $buttonText ?? 'Save' }}</button>
<a href="{{ route('sys.posts.index') }}" class="btn btn-outline-secondary">Cancel</a>



@push('styles')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.css">
@endpush

@push('scripts')
  {{-- Only include jQuery if your admin layout doesn’t already have it --}}
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.js"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const $el = $('#content_editor');
      if (!$el.length) return;

      $el.summernote({
        placeholder: 'Write your post content here...',
        tabsize: 2,
        height: 320
      });
    });
  </script>
@endpush