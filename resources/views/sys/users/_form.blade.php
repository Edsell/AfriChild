@php
  $u = $user ?? null;
@endphp

<div class="row g-3">
  <div class="col-md-12">
    <label class="form-label">Role</label>
    <select name="role" class="form-select" required>
      @foreach(($roles ?? []) as $r)
        <option value="{{ $r }}" @selected(old('role', $u->role ?? 'reader') === $r)>
          {{ ucfirst($r) }}
        </option>
      @endforeach
    </select>
    @error('role') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
  </div>

  <div class="col-md-6">
    <label class="form-label">Name</label>
    <input class="form-control" type="text" name="name" value="{{ old('name', $u->name ?? '') }}" required>
    @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
  </div>

  <div class="col-md-6">
    <label class="form-label">Email</label>
    <input class="form-control" type="email" name="email" value="{{ old('email', $u->email ?? '') }}" required>
    @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
  </div>

  <div class="col-md-6">
    <label class="form-label">
      {{ ($mode ?? 'create') === 'edit' ? 'New Password (optional)' : 'Password' }}
    </label>
    <input class="form-control" type="password" name="password"
           placeholder="{{ ($mode ?? 'create') === 'edit' ? 'Leave blank to keep current' : '' }}">
    @error('password') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
  </div>

  <div class="col-md-6">
    <label class="form-label">Confirm Password</label>
    <input class="form-control" type="password" name="password_confirmation">
  </div>
</div>
