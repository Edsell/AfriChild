<div class="d-flex align-items-center gap-2 mb-2">
  <i class="bx bx-list-check text-primary"></i>
  <h6 class="mb-0">Services</h6>
</div>
<div class="text-muted mb-3">
  Services are shown on the Home Page as service cards. Each service has a title, optional icon class or image, excerpt, and optional full description.
</div>

<div class="alert alert-primary d-flex align-items-start gap-2">
  <i class="bx bx-bulb mt-1"></i>
  <div>
    <div class="fw-semibold">Quick tip</div>
    <div>
      The <span class="fw-semibold">Excerpt</span> is what appears on the home cards.
      The <span class="fw-semibold">Description</span> is optional (use it if your design shows a full service page/section).
    </div>
  </div>
</div>

<button class="btn btn-primary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#svcGuide">
  Open Services guide
</button>

<div class="collapse show mt-3" id="svcGuide">

  <div class="row g-3">
    <div class="col-12 col-lg-6">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <div class="fw-semibold mb-2">Create a Service</div>

          <ol class="mb-0">
            <li>Go to <span class="fw-semibold">Home Page → Services</span>.</li>
            <li>Click <span class="fw-semibold">Create Service</span> / <span class="fw-semibold">Add New</span> (depending on your list page button).</li>
            <li>Fill the required field: <span class="fw-semibold">Title *</span>.</li>
            <li>(Optional) Set <span class="fw-semibold">Icon Class</span> (example: <code>fa fa-recycle</code>). Default is <code>fa fa-leaf</code>.</li>
            <li>Enter <span class="fw-semibold">Excerpt</span> (short summary shown on home cards, max 255 characters).</li>
            <li>Set <span class="fw-semibold">Sort Order</span> (lower numbers show first).</li>
            <li>(Optional) Upload <span class="fw-semibold">Image</span>.
              <div class="small text-muted mt-1">
                Uploads to <code>public/uploads/services</code>.
              </div>
            </li>
            <li>(Optional) Enter <span class="fw-semibold">Description</span> (full description).</li>
            <li>(Optional) Fill SEO fields:
              <span class="fw-semibold">Meta Title</span>,
              <span class="fw-semibold">Meta Keywords</span>,
              <span class="fw-semibold">Meta Description</span>.
            </li>
            <li>Ensure <span class="fw-semibold">Active</span> is checked.</li>
            <li>Click <span class="fw-semibold">Save</span>.</li>
          </ol>

        </div>
      </div>
    </div>

    <div class="col-12 col-lg-6">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <div class="fw-semibold mb-2">Edit / Update a Service</div>

          <ol class="mb-0">
            <li>Open <span class="fw-semibold">Home Page → Services</span>.</li>
            <li>Click <span class="fw-semibold">Edit</span> on the service you want to update.</li>
            <li>Update fields as needed (Title, Excerpt, Icon Class, Image, etc.).</li>
            <li>Click <span class="fw-semibold">Save</span> / <span class="fw-semibold">Update</span>.</li>
          </ol>

          <hr class="my-3" />

          <div class="fw-semibold mb-2">Verify on website</div>
          <ul class="mb-0">
            <li>Use <span class="fw-semibold">View Website</span> and check the Home Page services section.</li>
            <li>Confirm ordering matches <span class="fw-semibold">Sort Order</span>.</li>
            <li>If an item is missing, confirm <span class="fw-semibold">Active</span> is checked.</li>
          </ul>

        </div>
      </div>
    </div>

    <div class="col-12">
      <div class="card shadow-sm">
        <div class="card-body">
          <div class="fw-semibold mb-2">Common mistakes & fixes</div>

          <div class="accordion" id="svcFaq">
            <div class="accordion-item">
              <h2 class="accordion-header" id="svcFaq1h">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#svcFaq1">
                  Service not showing on Home Page
                </button>
              </h2>
              <div id="svcFaq1" class="accordion-collapse collapse show" data-bs-parent="#svcFaq">
                <div class="accordion-body">
                  Check that <span class="fw-semibold">Active</span> is checked, then refresh the website.
                  Also confirm your Home Page template is configured to display services.
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header" id="svcFaq2h">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#svcFaq2">
                  Icon not appearing
                </button>
              </h2>
              <div id="svcFaq2" class="accordion-collapse collapse" data-bs-parent="#svcFaq">
                <div class="accordion-body">
                  Ensure <span class="fw-semibold">Icon Class</span> uses a valid FontAwesome class name (example: <code>fa fa-leaf</code>).
                  If your theme uses a different icon library, update the class accordingly.
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header" id="svcFaq3h">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#svcFaq3">
                  Image uploaded but not showing
                </button>
              </h2>
              <div id="svcFaq3" class="accordion-collapse collapse" data-bs-parent="#svcFaq">
                <div class="accordion-body">
                  Confirm the upload succeeded and the file is stored in <code>public/uploads/services</code>.
                  If the image is too large, resize/compress and upload again.
                </div>
              </div>
            </div>

          </div>

        </div>
      </div>
    </div>

  </div>
</div>