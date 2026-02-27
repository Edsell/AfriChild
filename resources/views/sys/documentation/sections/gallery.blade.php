<div class="d-flex align-items-center gap-2 mb-2">
  <i class="bx bx-images text-primary"></i>
  <h6 class="mb-0">Gallery</h6>
</div>

<div class="text-muted mb-3">
  The Gallery module manages photos displayed on the website. Some setups use <span class="fw-semibold">Albums</span> (grouping photos),
  while others allow uploading images directly into one gallery list.
</div>

<div class="alert alert-primary d-flex align-items-start gap-2">
  <i class="bx bx-bulb mt-1"></i>
  <div>
    <div class="fw-semibold">Recommended approach</div>
    <div>
      Use albums for better organization (e.g., “Community Outreach 2025”, “Training Workshop”, “School Visits”).
      Keep image sizes consistent and web-optimized for faster loading.
    </div>
  </div>
</div>

<button class="btn btn-primary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#galleryGuide">
  Open Gallery guide
</button>

<div class="collapse show mt-3" id="galleryGuide">

  <div class="row g-3">

    <div class="col-12 col-lg-6">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <div class="fw-semibold mb-2">If your Gallery uses Albums</div>

          <ol class="mb-0">
            <li>Go to <span class="fw-semibold">Gallery</span> in the MIS sidebar.</li>
            <li>Click <span class="fw-semibold">Add New Album</span> / <span class="fw-semibold">Create Album</span>.</li>
            <li>Enter the <span class="fw-semibold">Album Title *</span>.</li>
            <li>(Optional) Add a short <span class="fw-semibold">Description</span>.</li>
            <li>(Optional) Upload an <span class="fw-semibold">Album Cover Image</span>.</li>
            <li>Set <span class="fw-semibold">Sort Order</span> (if available).</li>
            <li>Enable <span class="fw-semibold">Active</span> so the album is visible.</li>
            <li>Click <span class="fw-semibold">Save</span>.</li>
            <li>Open the album and click <span class="fw-semibold">Add Photos</span> / <span class="fw-semibold">Upload Images</span>.</li>
            <li>Upload multiple images (if supported) and add captions (optional).</li>
            <li>Save, then verify on the website.</li>
          </ol>

        </div>
      </div>
    </div>

    <div class="col-12 col-lg-6">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <div class="fw-semibold mb-2">If your Gallery is a direct Images list</div>

          <ol class="mb-0">
            <li>Go to <span class="fw-semibold">Gallery</span>.</li>
            <li>Click <span class="fw-semibold">Add New</span> / <span class="fw-semibold">Upload Image</span>.</li>
            <li>Upload the <span class="fw-semibold">Image *</span>.</li>
            <li>(Optional) Enter a <span class="fw-semibold">Title</span> or <span class="fw-semibold">Caption</span>.</li>
            <li>(Optional) Choose a <span class="fw-semibold">Category/Album</span> if the form provides it.</li>
            <li>Set <span class="fw-semibold">Sort Order</span> (if available).</li>
            <li>Enable <span class="fw-semibold">Active</span> to display publicly.</li>
            <li>Click <span class="fw-semibold">Save</span>.</li>
          </ol>

        </div>
      </div>
    </div>

    <div class="col-12">
      <div class="card shadow-sm">
        <div class="card-body">
          <div class="fw-semibold mb-2">Verify on website</div>
          <ul class="mb-0">
            <li>Open <span class="fw-semibold">View Website</span> → Gallery page.</li>
            <li>Confirm images load and appear in the correct album/order.</li>
            <li>If an image/album is missing, confirm <span class="fw-semibold">Active</span> is enabled.</li>
          </ul>

          <hr class="my-3" />

          <div class="fw-semibold mb-2">Common issues & fixes</div>
          <div class="accordion" id="galleryFaq">

            <div class="accordion-item">
              <h2 class="accordion-header" id="galleryFaq1h">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#galleryFaq1">
                  Images are not showing on the website
                </button>
              </h2>
              <div id="galleryFaq1" class="accordion-collapse collapse show" data-bs-parent="#galleryFaq">
                <div class="accordion-body">
                  Confirm <span class="fw-semibold">Active</span> is enabled for the album and/or image.
                  Then refresh the website page.
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header" id="galleryFaq2h">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#galleryFaq2">
                  Upload fails or takes too long
                </button>
              </h2>
              <div id="galleryFaq2" class="accordion-collapse collapse" data-bs-parent="#galleryFaq">
                <div class="accordion-body">
                  Large files may fail. Resize/compress images and try again.
                  Prefer JPG for photos and PNG only when transparency is needed.
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header" id="galleryFaq3h">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#galleryFaq3">
                  Images look inconsistent in grid
                </button>
              </h2>
              <div id="galleryFaq3" class="accordion-collapse collapse" data-bs-parent="#galleryFaq">
                <div class="accordion-body">
                  Use consistent image aspect ratios and avoid mixing very tall/very wide images in the same album.
                  Crop images before uploading for a cleaner layout.
                </div>
              </div>
            </div>

          </div>

        </div>
      </div>
    </div>

  </div>
</div>