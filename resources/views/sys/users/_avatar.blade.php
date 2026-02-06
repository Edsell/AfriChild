<div class="d-flex align-items-start align-items-sm-center gap-4 pb-4 border-bottom">
  <img
    src="{{ $user->avatar ? asset($user->avatar) : asset('bootstrap/assets/img/avatars/1.png') }}"
    class="d-block rounded"
    style="width:100px;height:100px;object-fit:cover;"
    alt="user-avatar"
  />

  <div class="button-wrapper">
    <form action="{{ route('sys.users.avatar.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="d-flex flex-column gap-2">
      @csrf

      <div class="d-flex gap-2 flex-wrap">
        <label class="btn btn-primary mb-0" tabindex="0">
          <span class="d-none d-sm-block">Upload new photo</span>
          <i class="bx bx-upload d-block d-sm-none"></i>
          <input type="file" name="avatar" hidden accept="image/*">
        </label>

        <button type="submit" class="btn btn-outline-success">
          Save
        </button>

        @if($user->avatar)
          <form action="{{ route('sys.users.avatar.delete', $user->id) }}" method="POST"
                onsubmit="return confirm('Remove this avatar?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-outline-danger">Remove</button>
          </form>
        @endif
      </div>

      @error('avatar') <div class="text-danger small">{{ $message }}</div> @enderror
      <small class="text-muted">Allowed JPG/PNG/GIF/WEBP/SVG. Max 4MB.</small>
    </form>
  </div>
</div>
