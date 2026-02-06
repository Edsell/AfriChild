<form action="{{ route('sys.settings.logo', $item) }}" method="POST" enctype="multipart/form-data">
  @csrf

  <div class="row g-2 align-items-center">
    <div class="col-9">
      <input class="form-control" type="file" name="Logo" accept="image/*" required>
    </div>
    <div class="col-3 d-grid">
      <button type="submit" class="btn btn-primary">
        <i class="bx bx-check"></i>
      </button>
    </div>
  </div>
</form>
