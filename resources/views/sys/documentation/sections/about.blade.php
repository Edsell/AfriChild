<div class="d-flex align-items-center gap-2 mb-2">
  <i class="bx bx-info-circle text-primary"></i>
  <h6 class="mb-0">About</h6>
</div>

<div class="text-muted mb-3">
  The About module controls the public “About Us / About AfriChild” page content.
  Depending on how the page was implemented, content may be stored as direct fields (heading/body/image)
  or inside a <code>content</code> JSON structure.
</div>

<div class="alert alert-warning d-flex align-items-start gap-2">
  <i class="bx bx-error-circle mt-1"></i>
  <div>
    <div class="fw-semibold">Important</div>
    <div>
      If the website is not reflecting changes, confirm you edited the correct record and that it is set to
      <span class="fw-semibold">Active</span>. Also confirm images are loading correctly after save.
    </div>
  </div>
</div>

<button class="btn btn-primary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#aboutGuide">
  Open About guide
</button>

<div class="collapse show mt-3" id="aboutGuide">

  <div class="row g-3">

    <div class="col-12 col-lg-6">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <div class="fw-semibold mb-2">Update About page (standard fields)</div>

          <ol class="mb-0">
            <li>Go to <span class="fw-semibold">About</span> in the MIS sidebar.</li>
            <li>Open the existing About record (click <span class="fw-semibold">Edit</span>).</li>
            <li>
              Update the page title fields if available:
              <span class="fw-semibold">Title</span> / <span class="fw-semibold">Page Title</span> /
              <span class="fw-semibold">Heading</span>.
            </li>
            <li>
              Update the main body field:
              <span class="fw-semibold">Body</span> / <span class="fw-semibold">Description</span> /
              <span class="fw-semibold">Content</span>.
            </li>
            <li>
              If there is an image field:
              upload/replace the <span class="fw-semibold">About Image</span>.
            </li>
            <li>Confirm <span class="fw-semibold">Active</span> is enabled (checked).</li>
            <li>Click <span class="fw-semibold">Save</span> / <span class="fw-semibold">Update</span>.</li>
          </ol>

          <hr class="my-3" />

          <div class="fw-semibold mb-2">Verify</div>
          <ul class="mb-0">
            <li>Open <span class="fw-semibold">View Website</span> → About page.</li>
            <li>Confirm the heading, text, and image appear correctly.</li>
          </ul>

        </div>
      </div>
    </div>

    <div class="col-12 col-lg-6">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <div class="fw-semibold mb-2">Update About page (content JSON fields)</div>

          <div class="text-muted mb-2">
            Some AfriChild pages store content inside a <code>content</code> JSON array/object
            (for example: heading, sections, or blocks).
          </div>

          <ol class="mb-0">
            <li>Go to <span class="fw-semibold">About</span>.</li>
            <li>Edit the active record.</li>
            <li>
              Locate the content editor area (it may be a dynamic “content blocks” UI, or a set of fields that map into JSON).
            </li>
            <li>
              Update key fields commonly used:
              <span class="fw-semibold">heading</span>,
              <span class="fw-semibold">page_title</span>,
              section text blocks, and any lists/items.
            </li>
            <li>
              If an image is part of the content blocks, upload/replace it and save.
            </li>
            <li>Ensure <span class="fw-semibold">Active</span> is enabled.</li>
            <li>Save and verify on the website.</li>
          </ol>

          <hr class="my-3" />

          <div class="fw-semibold mb-2">If the frontend still doesn’t update</div>
          <ul class="mb-0">
            <li>Hard refresh the website page (Ctrl/⌘ + Shift + R).</li>
            <li>Confirm the record you edited is the one used on the frontend.</li>
            <li>Confirm the image path resolves correctly after saving.</li>
          </ul>

        </div>
      </div>
    </div>

    <div class="col-12">
      <div class="card shadow-sm">
        <div class="card-body">
          <div class="fw-semibold mb-2">Content guidelines (recommended)</div>
          <ul class="mb-0">
            <li>Use short sections with headings (readable on mobile).</li>
            <li>Avoid pasting directly from Word/PDF — paste as plain text then format lightly.</li>
            <li>Use real numbers/facts only if verified (partners, dates, achievements).</li>
            <li>Keep images optimized (web-friendly size) for faster loading.</li>
          </ul>

          <hr class="my-3" />

          <div class="fw-semibold mb-2">Common issues & fixes</div>
          <div class="accordion" id="aboutFaq">

            <div class="accordion-item">
              <h2 class="accordion-header" id="aboutFaq1h">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#aboutFaq1">
                  Changes saved but not showing on the website
                </button>
              </h2>
              <div id="aboutFaq1" class="accordion-collapse collapse show" data-bs-parent="#aboutFaq">
                <div class="accordion-body">
                  Ensure the record is <span class="fw-semibold">Active</span>, and that the frontend is reading from the same record.
                  Then hard refresh the website page.
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header" id="aboutFaq2h">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#aboutFaq2">
                  Image appears in backend preview but not on frontend
                </button>
              </h2>
              <div id="aboutFaq2" class="accordion-collapse collapse" data-bs-parent="#aboutFaq">
                <div class="accordion-body">
                  This is often a path issue. Confirm the frontend uses the correct disk/path for the saved image.
                  If you recently changed storage strategy, align frontend retrieval to the saved file location.
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header" id="aboutFaq3h">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#aboutFaq3">
                  Content looks messy after paste
                </button>
              </h2>
              <div id="aboutFaq3" class="accordion-collapse collapse" data-bs-parent="#aboutFaq">
                <div class="accordion-body">
                  Remove hidden formatting by pasting as plain text, then re-add minimal formatting (bold, lists, headings).
                </div>
              </div>
            </div>

          </div>

        </div>
      </div>
    </div>

  </div>
</div>