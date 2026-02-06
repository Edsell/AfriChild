@csrf

@php
  // Use passed in $typeOptions from controller if available, else fallback
  $typeOptions = $typeOptions ?? \App\Models\TeamMember::typeOptions();
@endphp

@if($errors->any())
  <div class="alert alert-danger">
    <ul class="mb-0">
      @foreach($errors->all() as $e)
        <li>{{ $e }}</li>
      @endforeach
    </ul>
  </div>
@endif

<div class="row">
  <div class="col-md-6 mb-3">
    <label class="form-label">Name</label>
    <input name="name" value="{{ old('name', $member->name ?? '') }}"
      class="form-control @error('name') is-invalid @enderror">
    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  <div class="col-md-6 mb-3">
    <label class="form-label">Designation</label>
    <input name="designation" value="{{ old('designation', $member->designation ?? '') }}"
      class="form-control @error('designation') is-invalid @enderror">
    @error('designation') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>
</div>

<div class="row">
  <div class="col-md-6 mb-3">
    <label class="form-label">Type</label>
    <select name="type" class="form-select @error('type') is-invalid @enderror" required>
      @foreach($typeOptions as $val => $label)
        <option value="{{ $val }}"
          @selected(old('type', $member->type ?? 'secretariat') === $val)>
          {{ $label }}
        </option>
      @endforeach
    </select>
    @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  <div class="col-md-6 mb-3">
    <label class="form-label">Slug (optional)</label>
    <input name="slug" value="{{ old('slug', $member->slug ?? '') }}"
      class="form-control @error('slug') is-invalid @enderror">
    @error('slug') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>
</div>

<div class="mb-3">
  <label class="form-label">Photo</label>
  <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror">
  @error('photo') <div class="invalid-feedback">{{ $message }}</div> @enderror

  @if(!empty($member?->photo))
    <div class="mt-3">
      <img src="{{ asset(ltrim($member->photo, '/')) }}" style="max-height:120px;border-radius:10px;">
      <div class="form-check mt-2">
        <input class="form-check-input" type="checkbox" name="remove_photo" value="1" id="removePhoto">
        <label class="form-check-label" for="removePhoto">Remove current photo</label>
      </div>
    </div>
  @endif
</div>

<div class="row">
  <div class="col-md-3 mb-3">
    <label class="form-label">Sort Order</label>
    <input type="number" min="0" name="sort_order" value="{{ old('sort_order', $member->sort_order ?? 0) }}"
      class="form-control @error('sort_order') is-invalid @enderror">
    @error('sort_order') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  <div class="col-md-3 mb-3 d-flex align-items-end">
    <div class="form-check form-switch">
      <input class="form-check-input" type="checkbox" name="is_active" value="1" id="active"
        {{ old('is_active', $member->is_active ?? true) ? 'checked' : '' }}>
      <label class="form-check-label" for="active">Active</label>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-3 mb-3">
    <label class="form-label">Facebook</label>
    <input name="facebook" value="{{ old('facebook', $member->facebook ?? '') }}" class="form-control">
  </div>
  <div class="col-md-3 mb-3">
    <label class="form-label">Twitter / X</label>
    <input name="twitter" value="{{ old('twitter', $member->twitter ?? '') }}" class="form-control">
  </div>
  <div class="col-md-3 mb-3">
    <label class="form-label">LinkedIn</label>
    <input name="linkedin" value="{{ old('linkedin', $member->linkedin ?? '') }}" class="form-control">
  </div>
  <div class="col-md-3 mb-3">
    <label class="form-label">Instagram</label>
    <input name="instagram" value="{{ old('instagram', $member->instagram ?? '') }}" class="form-control">
  </div>
</div>

<div class="mb-3">
  <label class="form-label">Bio</label>
  <textarea name="bio" rows="4" class="form-control">{{ old('bio', $member->bio ?? '') }}</textarea>
</div>

<button class="btn btn-success">{{ $buttonText ?? 'Save' }}</button>
<a href="{{ route('sys.team-members.index') }}" class="btn btn-outline-secondary">Cancel</a>
