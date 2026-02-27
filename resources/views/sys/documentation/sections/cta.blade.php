<div class="d-flex align-items-center gap-2 mb-2">
  <i class="bx bx-bullseye text-primary"></i>
  <h6 class="mb-0">CTA</h6>
</div>

<div class="text-muted mb-3">
  The CTA (Call-To-Action) section controls the homepage CTA block — usually a background image + heading/text + “progress/percent” items.
</div>

<div class="alert alert-primary d-flex align-items-start gap-2">
  <i class="bx bx-bulb mt-1"></i>
  <div>
    <div class="fw-semibold">Quick tip</div>
    <div>
      Keep CTA text short and action-oriented. If your CTA uses percent rings, keep values realistic (0–100) and use consistent labels.
    </div>
  </div>
</div>

<button class="btn btn-primary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#ctaGuide">
  Open CTA guide
</button>

<div class="collapse show mt-3" id="ctaGuide">

  <div class="row g-3">

    {{-- MAIN CTA SECTION --}}
    <div class="col-12 col-lg-6">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <div class="fw-semibold mb-2">Configure the CTA section</div>

          <ol class="mb-0">
            <li>Go to <span class="fw-semibold">Home Page → CTA</span>.</li>
            <li>
              If there is an existing CTA record, click <span class="fw-semibold">Edit</span>.
              If your system allows creating one, click <span class="fw-semibold">Add New</span>.
            </li>
            <li>
              Update the CTA main text fields (commonly
              <span class="fw-semibold">Title / Heading</span> and
              <span class="fw-semibold">Subtitle / Description</span>).
            </li>
            <li>
              Upload/replace the <span class="fw-semibold">Background Image</span> (if provided).
              <div class="small text-muted mt-1">
                Use a high-quality image; ensure text remains readable on top.
              </div>
            </li>
            <li>
              Configure optional display settings (if present), such as overlay, alignment, or animation.
            </li>
            <li>Ensure <span class="fw-semibold">Active</span> is enabled.</li>
            <li>Click <span class="fw-semibold">Save</span>.</li>
          </ol>

        </div>
      </div>
    </div>

    {{-- CTA ITEMS --}}
    <div class="col-12 col-lg-6">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <div class="fw-semibold mb-2">Add / manage CTA items (Percent blocks)</div>

          <ol class="mb-0">
            <li>Inside the CTA page, locate the <span class="fw-semibold">CTA Items</span> section/list.</li>
            <li>Click <span class="fw-semibold">Add New Item</span>.</li>
            <li>Enter the item <span class="fw-semibold">Title</span> (example: “Children Supported”).</li>
            <li>
              Set the <span class="fw-semibold">Percent</span> value (0–100).
              <div class="small text-muted mt-1">
                This is typically used for a ring/progress indicator.
              </div>
            </li>
            <li>
              (Optional) Add short text/description or icon/image if your item form supports it.
            </li>
            <li>Set <span class="fw-semibold">Sort Order</span> (controls display order).</li>
            <li>Enable <span class="fw-semibold">Active</span> for the item.</li>
            <li>Click <span class="fw-semibold">Save</span>.</li>
          </ol>

        </div>
      </div>
    </div>

    {{-- VERIFY --}}
    <div class="col-12">
      <div class="card shadow-sm">
        <div class="card-body">
          <div class="fw-semibold mb-2">Verify on the website</div>
          <ul class="mb-0">
            <li>Click <span class="fw-semibold">View Website</span> and open the Home Page.</li>
            <li>Scroll to the CTA section and confirm:
              <ul class="mt-1">
                <li>Background image loads correctly</li>
                <li>CTA heading/text is readable</li>
                <li>Percent items appear in the correct order</li>
                <li>Percent values look correct (0–100)</li>
              </ul>
            </li>
            <li>If CTA is not visible, confirm the CTA record is <span class="fw-semibold">Active</span>.</li>
          </ul>
        </div>
      </div>
    </div>

    {{-- FAQ --}}
    <div class="col-12">
      <div class="card shadow-sm">
        <div class="card-body">
          <div class="fw-semibold mb-2">Common issues & fixes</div>

          <div class="accordion" id="ctaFaq">

            <div class="accordion-item">
              <h2 class="accordion-header" id="ctaFaq1h">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#ctaFaq1">
                  CTA section not showing
                </button>
              </h2>
              <div id="ctaFaq1" class="accordion-collapse collapse show" data-bs-parent="#ctaFaq">
                <div class="accordion-body">
                  Confirm the CTA record is <span class="fw-semibold">Active</span>. If multiple CTA records exist,
                  make sure the intended one is active and used by the homepage template.
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header" id="ctaFaq2h">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#ctaFaq2">
                  Percent ring/value looks wrong
                </button>
              </h2>
              <div id="ctaFaq2" class="accordion-collapse collapse" data-bs-parent="#ctaFaq">
                <div class="accordion-body">
                  Ensure the item <span class="fw-semibold">Percent</span> is between 0 and 100.
                  Also verify you saved the correct item and refreshed the website.
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header" id="ctaFaq3h">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#ctaFaq3">
                  Background image uploaded but not displaying
                </button>
              </h2>
              <div id="ctaFaq3" class="accordion-collapse collapse" data-bs-parent="#ctaFaq">
                <div class="accordion-body">
                  Confirm the upload completed and the record was saved. If the image is too large, compress it and upload again.
                  Also ensure the frontend references the correct storage path.
                </div>
              </div>
            </div>

          </div>

        </div>
      </div>
    </div>

  </div>
</div>