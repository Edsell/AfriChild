<div class="d-flex align-items-center gap-2 mb-2">
  <i class="bx bx-group text-primary"></i>
  <h6 class="mb-0">Team</h6>
</div>

<div class="text-muted mb-3">
  The Team module manages staff/board profiles displayed on the website. Each member usually includes a name, role/position,
  photo, and a short bio (and sometimes social links).
</div>

<div class="alert alert-primary d-flex align-items-start gap-2">
  <i class="bx bx-bulb mt-1"></i>
  <div>
    <div class="fw-semibold">Profile tip</div>
    <div>
      Use consistent headshot style (similar crop/size). Keep bios short and professional (2–5 lines works well).
    </div>
  </div>
</div>

<button class="btn btn-primary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#teamGuide">
  Open Team guide
</button>

<div class="collapse show mt-3" id="teamGuide">

  <div class="row g-3">

    <div class="col-12 col-lg-6">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <div class="fw-semibold mb-2">Add a Team Member</div>

          <ol class="mb-0">
            <li>Go to <span class="fw-semibold">Team</span> in the MIS sidebar.</li>
            <li>Click <span class="fw-semibold">Add New</span> / <span class="fw-semibold">Create Member</span>.</li>
            <li>Enter <span class="fw-semibold">Full Name *</span>.</li>
            <li>Enter <span class="fw-semibold">Position / Role</span> (example: “Program Officer”).</li>
            <li>
              Upload a <span class="fw-semibold">Profile Photo</span>.
              <div class="small text-muted mt-1">
                Use a clear headshot; crop to a consistent ratio for a clean team grid.
              </div>
            </li>
            <li>Add a short <span class="fw-semibold">Bio / Description</span> (optional but recommended).</li>
            <li>
              (Optional) Fill social links if the form includes them:
              <span class="fw-semibold">Facebook</span>, <span class="fw-semibold">X/Twitter</span>,
              <span class="fw-semibold">LinkedIn</span>, <span class="fw-semibold">Instagram</span>.
            </li>
            <li>Set <span class="fw-semibold">Sort Order</span> (lower values show first).</li>
            <li>Enable <span class="fw-semibold">Active</span> to show publicly.</li>
            <li>Click <span class="fw-semibold">Save</span>.</li>
          </ol>

        </div>
      </div>
    </div>

    <div class="col-12 col-lg-6">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <div class="fw-semibold mb-2">Edit / Hide a Team Member</div>

          <ol class="mb-0">
            <li>Go to <span class="fw-semibold">Team</span>.</li>
            <li>Find the member and click <span class="fw-semibold">Edit</span>.</li>
            <li>Update details (role, bio, photo, links) as needed.</li>
            <li>
              To remove from the website without deleting, disable <span class="fw-semibold">Active</span>.
            </li>
            <li>Click <span class="fw-semibold">Save</span> / <span class="fw-semibold">Update</span>.</li>
          </ol>

          <hr class="my-3" />

          <div class="fw-semibold mb-2">Verify</div>
          <ul class="mb-0">
            <li>Open <span class="fw-semibold">View Website</span> → Team page/section.</li>
            <li>Confirm the member appears in the correct order (Sort Order).</li>
            <li>Open the profile (if clickable) and confirm bio and image load correctly.</li>
          </ul>

        </div>
      </div>
    </div>

    <div class="col-12">
      <div class="card shadow-sm">
        <div class="card-body">
          <div class="fw-semibold mb-2">Common issues & fixes</div>

          <div class="accordion" id="teamFaq">

            <div class="accordion-item">
              <h2 class="accordion-header" id="teamFaq1h">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#teamFaq1">
                  Team member not showing on the website
                </button>
              </h2>
              <div id="teamFaq1" class="accordion-collapse collapse show" data-bs-parent="#teamFaq">
                <div class="accordion-body">
                  Confirm <span class="fw-semibold">Active</span> is enabled.
                  Also confirm your website template displays Team members (some pages show only specific groups/roles).
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header" id="teamFaq2h">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#teamFaq2">
                  Photo looks stretched or blurry
                </button>
              </h2>
              <div id="teamFaq2" class="accordion-collapse collapse" data-bs-parent="#teamFaq">
                <div class="accordion-body">
                  Use a properly cropped headshot and upload a higher quality image.
                  If the photo is too large, compress it without losing clarity.
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header" id="teamFaq3h">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#teamFaq3">
                  Ordering is wrong
                </button>
              </h2>
              <div id="teamFaq3" class="accordion-collapse collapse" data-bs-parent="#teamFaq">
                <div class="accordion-body">
                  Update <span class="fw-semibold">Sort Order</span>.
                  Lower numbers appear first.
                </div>
              </div>
            </div>

          </div>

        </div>
      </div>
    </div>

  </div>
</div>