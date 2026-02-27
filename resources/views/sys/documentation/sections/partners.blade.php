<div class="d-flex align-items-center gap-2 mb-2">
  <i class="bx bx-building-house text-primary"></i>
  <h6 class="mb-0">Partners</h6>
</div>

<div class="text-muted mb-3">
  Partners are organizations displayed on the website (logos/names). This module supports two use cases:
  <span class="fw-semibold">Founding Partners</span> (shown publicly) and <span class="fw-semibold">General Partners</span> (kept inactive unless you want them displayed).
</div>

<div class="alert alert-warning d-flex align-items-start gap-2">
  <i class="bx bx-error-circle mt-1"></i>
  <div>
    <div class="fw-semibold">Important rule (AfriChild)</div>
    <div>
      When adding <span class="fw-semibold">Our Founding Partners</span>, keep <span class="fw-semibold">Status / Active</span> enabled.<br>
      For other <span class="fw-semibold">General Partners</span>, keep <span class="fw-semibold">Status / Active</span> disabled (inactive) by default.
    </div>
  </div>
</div>

<button class="btn btn-primary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#partnersGuide">
  Open Partners guide
</button>

<div class="collapse show mt-3" id="partnersGuide">

  <div class="row g-3">

    <div class="col-12 col-lg-6">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <div class="fw-semibold mb-2">Add a Founding Partner (Active)</div>

          <ol class="mb-0">
            <li>Go to <span class="fw-semibold">Home Page → Partners</span>.</li>
            <li>Click <span class="fw-semibold">Add New</span> / <span class="fw-semibold">Create Partner</span>.</li>
            <li>Enter the partner <span class="fw-semibold">Name</span> (required).</li>
            <li>Upload the <span class="fw-semibold">Logo</span> (transparent PNG recommended).</li>
            <li>Set <span class="fw-semibold">Sort Order</span> (lower shows first).</li>
            <li>
              Set <span class="fw-semibold">Status / Active</span> to
              <span class="badge bg-label-success">Active</span> (checked).
            </li>
            <li>Click <span class="fw-semibold">Save</span>.</li>
          </ol>

          <hr class="my-3" />

          <div class="fw-semibold mb-2">Verify</div>
          <ul class="mb-0">
            <li>Open <span class="fw-semibold">View Website</span> and check the partners section.</li>
            <li>Confirm the logo is sharp and not stretched.</li>
            <li>Confirm ordering matches <span class="fw-semibold">Sort Order</span>.</li>
          </ul>
        </div>
      </div>
    </div>

    <div class="col-12 col-lg-6">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <div class="fw-semibold mb-2">Add a General Partner (Inactive by default)</div>

          <ol class="mb-0">
            <li>Go to <span class="fw-semibold">Home Page → Partners</span>.</li>
            <li>Click <span class="fw-semibold">Add New</span> / <span class="fw-semibold">Create Partner</span>.</li>
            <li>Enter the partner <span class="fw-semibold">Name</span>.</li>
            <li>Upload the <span class="fw-semibold">Logo</span> (if available).</li>
            <li>Set <span class="fw-semibold">Sort Order</span>.</li>
            <li>
              Set <span class="fw-semibold">Status / Active</span> to
              <span class="badge bg-label-secondary">Inactive</span> (unchecked).
            </li>
            <li>Click <span class="fw-semibold">Save</span>.</li>
          </ol>

          <hr class="my-3" />

          <div class="fw-semibold mb-2">When to activate a General Partner</div>
          <ul class="mb-0">
            <li>Only enable Active when the partner should appear on the public site.</li>
            <li>After activating, confirm the partner appears and the logo looks consistent with others.</li>
          </ul>
        </div>
      </div>
    </div>

    <div class="col-12">
      <div class="card shadow-sm">
        <div class="card-body">
          <div class="fw-semibold mb-2">Common issues & fixes</div>

          <div class="accordion" id="partnersFaq">

            <div class="accordion-item">
              <h2 class="accordion-header" id="partnersFaq1h">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#partnersFaq1">
                  Partner not showing on the website
                </button>
              </h2>
              <div id="partnersFaq1" class="accordion-collapse collapse show" data-bs-parent="#partnersFaq">
                <div class="accordion-body">
                  Confirm <span class="fw-semibold">Active</span> is enabled for that partner and refresh the website.
                  If the rule says General Partners should be inactive, only activate when you truly want them shown.
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header" id="partnersFaq2h">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#partnersFaq2">
                  Logos look inconsistent (different sizes)
                </button>
              </h2>
              <div id="partnersFaq2" class="accordion-collapse collapse" data-bs-parent="#partnersFaq">
                <div class="accordion-body">
                  Use similar logo height across partners (transparent PNGs work best).
                  If a logo looks too tall/wide, resize it before uploading.
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header" id="partnersFaq3h">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#partnersFaq3">
                  Partner order is wrong
                </button>
              </h2>
              <div id="partnersFaq3" class="accordion-collapse collapse" data-bs-parent="#partnersFaq">
                <div class="accordion-body">
                  Update <span class="fw-semibold">Sort Order</span> values.
                  Lower numbers should appear first.
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

  </div>
</div>