<div class="d-flex align-items-center gap-2 mb-2">
  <i class="bx bx-target-lock text-primary"></i>
  <h6 class="mb-0">Mission</h6>
</div>

<div class="text-muted mb-3">
  The Mission section controls the homepage “Mission / What we do” block (heading + description, and sometimes an image).
</div>

<div class="alert alert-info d-flex align-items-start gap-2">
  <i class="bx bx-info-circle mt-1"></i>
  <div>
    <div class="fw-semibold">Best practice</div>
    <div>
      Keep Mission text short and clear. Aim for 1–2 short paragraphs (or bullet points if your template supports them).
    </div>
  </div>
</div>

<button class="btn btn-primary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#missionGuide">
  Open Mission guide
</button>

<div class="collapse show mt-3" id="missionGuide">

  <div class="row g-3">
    <div class="col-12 col-lg-6">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <div class="fw-semibold mb-2">Update Mission content</div>

          <ol class="mb-0">
            <li>Go to <span class="fw-semibold">Home Page → Mission</span>.</li>
            <li>
              If you see an existing Mission record, click <span class="fw-semibold">Edit</span>.
              If not, click <span class="fw-semibold">Add New</span>.
            </li>
            <li>
              Update the main heading field (commonly <span class="fw-semibold">Title</span> or <span class="fw-semibold">Heading</span>).
            </li>
            <li>
              Update the body field (commonly <span class="fw-semibold">Description</span>, <span class="fw-semibold">Content</span>, or <span class="fw-semibold">Body</span>).
            </li>
            <li>
              (Optional) Upload/replace the Mission <span class="fw-semibold">Image</span> if the form provides it.
            </li>
            <li>
              Set <span class="fw-semibold">Sort Order</span> (only relevant if multiple mission blocks are allowed).
            </li>
            <li>
              Ensure <span class="fw-semibold">Active</span> is checked so it shows on the website.
            </li>
            <li>
              (Optional) Fill SEO fields if present:
              <span class="fw-semibold">Meta Title</span>, <span class="fw-semibold">Meta Keywords</span>, <span class="fw-semibold">Meta Description</span>.
            </li>
            <li>Click <span class="fw-semibold">Save</span>.</li>
          </ol>

        </div>
      </div>
    </div>

    <div class="col-12 col-lg-6">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <div class="fw-semibold mb-2">Verify on website</div>

          <ul class="mb-0">
            <li>Click <span class="fw-semibold">View Website</span> and open the Home Page.</li>
            <li>Scroll to the Mission section and confirm the updated heading and text.</li>
            <li>If you uploaded an image, confirm it loads correctly and is not stretched.</li>
            <li>If it does not appear, re-check <span class="fw-semibold">Active</span> and save again.</li>
          </ul>

          <hr class="my-3" />

          <div class="fw-semibold mb-2">Content guidance</div>
          <ul class="mb-0">
            <li>Prefer short sentences and simple language.</li>
            <li>Use consistent capitalization and punctuation.</li>
            <li>Avoid very long paragraphs (they reduce readability on the homepage).</li>
          </ul>
        </div>
      </div>
    </div>

    <div class="col-12">
      <div class="card shadow-sm">
        <div class="card-body">
          <div class="fw-semibold mb-2">Common issues & fixes</div>

          <div class="accordion" id="missionFaq">

            <div class="accordion-item">
              <h2 class="accordion-header" id="missionFaq1h">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#missionFaq1">
                  Mission not showing on the website
                </button>
              </h2>
              <div id="missionFaq1" class="accordion-collapse collapse show" data-bs-parent="#missionFaq">
                <div class="accordion-body">
                  Confirm <span class="fw-semibold">Active</span> is enabled on the correct Mission record.
                  If multiple records exist, ensure only the intended one is active (depending on your template logic).
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header" id="missionFaq2h">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#missionFaq2">
                  Text formatting looks strange after paste
                </button>
              </h2>
              <div id="missionFaq2" class="accordion-collapse collapse" data-bs-parent="#missionFaq">
                <div class="accordion-body">
                  If you pasted from Word/PDF, remove hidden formatting by pasting as plain text, then re-add minimal formatting.
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header" id="missionFaq3h">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#missionFaq3">
                  Image uploaded but not showing
                </button>
              </h2>
              <div id="missionFaq3" class="accordion-collapse collapse" data-bs-parent="#missionFaq">
                <div class="accordion-body">
                  Confirm the upload succeeded and the page was saved.
                  If your system stores uploads under a specific folder, ensure the file exists there and the frontend path resolves correctly.
                </div>
              </div>
            </div>

          </div>

        </div>
      </div>
    </div>

  </div>
</div>