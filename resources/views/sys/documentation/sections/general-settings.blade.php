<div class="d-flex align-items-center gap-2 mb-2">
  <i class="bx bx-cog text-primary"></i>
  <h6 class="mb-0">General Settings</h6>
</div>

<div class="text-muted mb-3">
  General Settings control global website/system configuration such as organization details, branding (logos),
  contact information, and social links. Changes here affect the entire website.
</div>

<div class="alert alert-warning d-flex align-items-start gap-2">
  <i class="bx bx-error-circle mt-1"></i>
  <div>
    <div class="fw-semibold">Be careful</div>
    <div>
      These settings affect the whole website. Update only what you are sure about, then verify on the frontend immediately.
    </div>
  </div>
</div>

<button class="btn btn-primary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#settingsGuide">
  Open General Settings guide
</button>

<div class="collapse show mt-3" id="settingsGuide">

  <div class="row g-3">

    <div class="col-12 col-lg-6">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <div class="fw-semibold mb-2">Update organization & contact info</div>

          <ol class="mb-0">
            <li>Go to <span class="fw-semibold">General Settings</span> in the MIS sidebar.</li>
            <li>Update organization details (commonly):
              <span class="fw-semibold">Site/Organization Name</span>,
              <span class="fw-semibold">Email</span>,
              <span class="fw-semibold">Phone</span>,
              <span class="fw-semibold">Address</span>.
            </li>
            <li>
              If there is a “footer” section, update footer text and any quick links as provided.
            </li>
            <li>Click <span class="fw-semibold">Save</span> / <span class="fw-semibold">Update</span>.</li>
          </ol>

          <hr class="my-3" />

          <div class="fw-semibold mb-2">Verify</div>
          <ul class="mb-0">
            <li>Open <span class="fw-semibold">View Website</span> and check the header/footer contact details.</li>
            <li>Confirm phone/email links work correctly.</li>
          </ul>
        </div>
      </div>
    </div>

    <div class="col-12 col-lg-6">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <div class="fw-semibold mb-2">Update branding (logo / favicon) & social links</div>

          <ol class="mb-0">
            <li>Open <span class="fw-semibold">General Settings</span>.</li>
            <li>
              Upload/replace branding assets if available:
              <span class="fw-semibold">Logo</span>,
              <span class="fw-semibold">Footer Logo</span>,
              <span class="fw-semibold">Favicon</span>.
            </li>
            <li>
              Update social media URLs (commonly):
              <span class="fw-semibold">Facebook</span>,
              <span class="fw-semibold">X/Twitter</span>,
              <span class="fw-semibold">LinkedIn</span>,
              <span class="fw-semibold">Instagram</span>,
              <span class="fw-semibold">YouTube</span>.
            </li>
            <li>
              If SEO defaults exist, update:
              <span class="fw-semibold">Default Meta Title</span>,
              <span class="fw-semibold">Meta Description</span>,
              <span class="fw-semibold">Meta Keywords</span>.
            </li>
            <li>Click <span class="fw-semibold">Save</span>.</li>
          </ol>

          <hr class="my-3" />

          <div class="fw-semibold mb-2">Verify</div>
          <ul class="mb-0">
            <li>Refresh the website and confirm the logo and favicon changed.</li>
            <li>Click social icons in footer/header to confirm links go to the correct pages.</li>
          </ul>
        </div>
      </div>
    </div>

    <div class="col-12">
      <div class="card shadow-sm">
        <div class="card-body">
          <div class="fw-semibold mb-2">Common issues & fixes</div>

          <div class="accordion" id="settingsFaq">

            <div class="accordion-item">
              <h2 class="accordion-header" id="settingsFaq1h">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#settingsFaq1">
                  Logo updated but website still shows the old one
                </button>
              </h2>
              <div id="settingsFaq1" class="accordion-collapse collapse show" data-bs-parent="#settingsFaq">
                <div class="accordion-body">
                  Hard refresh the website (Ctrl/⌘ + Shift + R).
                  If a CDN/cache is used, clear the cache. Also confirm the new logo upload saved successfully.
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header" id="settingsFaq2h">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#settingsFaq2">
                  Social icon opens the wrong link
                </button>
              </h2>
              <div id="settingsFaq2" class="accordion-collapse collapse" data-bs-parent="#settingsFaq">
                <div class="accordion-body">
                  Re-check the URL format (include <code>https://</code>) and save again.
                  Then refresh the website and test the icon.
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header" id="settingsFaq3h">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#settingsFaq3">
                  Changes saved but not appearing anywhere
                </button>
              </h2>
              <div id="settingsFaq3" class="accordion-collapse collapse" data-bs-parent="#settingsFaq">
                <div class="accordion-body">
                  Confirm you edited the correct settings record (some systems have only one).
                  If your site uses cached settings, clear cache and refresh.
                </div>
              </div>
            </div>

          </div>

        </div>
      </div>
    </div>

  </div>
</div>