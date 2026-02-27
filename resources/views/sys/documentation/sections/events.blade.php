<div class="d-flex align-items-center gap-2 mb-2">
  <i class="bx bx-calendar-event text-primary"></i>
  <h6 class="mb-0">Events</h6>
</div>

<div class="text-muted mb-3">
  The Events module publishes upcoming and past events on the website (title, date/time, venue, description, and image/banner).
</div>

<div class="alert alert-primary d-flex align-items-start gap-2">
  <i class="bx bx-bulb mt-1"></i>
  <div>
    <div class="fw-semibold">Quick tip</div>
    <div>
      Use clear event titles, include a correct date/time and venue, and keep the first paragraph of the description short
      (it becomes the preview on many layouts).
    </div>
  </div>
</div>

<button class="btn btn-primary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#eventsGuide">
  Open Events guide
</button>

<div class="collapse show mt-3" id="eventsGuide">

  <div class="row g-3">

    <div class="col-12 col-lg-6">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <div class="fw-semibold mb-2">Create an Event</div>

          <ol class="mb-0">
            <li>Go to <span class="fw-semibold">Events</span> in the MIS sidebar.</li>
            <li>Click <span class="fw-semibold">Add New</span> / <span class="fw-semibold">Create Event</span>.</li>
            <li>Enter <span class="fw-semibold">Event Title *</span>.</li>
            <li>
              Set the <span class="fw-semibold">Event Date</span> (and <span class="fw-semibold">Time</span> if your form includes it).
            </li>
            <li>
              Enter the <span class="fw-semibold">Venue / Location</span> (physical location or “Online” if virtual).
            </li>
            <li>
              (Optional) Add an <span class="fw-semibold">Excerpt / Summary</span> if your form has it.
            </li>
            <li>
              Upload an <span class="fw-semibold">Event Banner / Featured Image</span>.
              <div class="small text-muted mt-1">
                Use a wide banner image if your frontend displays events as banners.
              </div>
            </li>
            <li>
              Write the <span class="fw-semibold">Description / Content</span> (agenda, speaker, audience, objectives).
            </li>
            <li>Set <span class="fw-semibold">Sort Order</span> (if available).</li>
            <li>Enable <span class="fw-semibold">Active</span> to publish.</li>
            <li>
              Fill SEO fields if present:
              <span class="fw-semibold">Meta Title</span>,
              <span class="fw-semibold">Meta Keywords</span>,
              <span class="fw-semibold">Meta Description</span>.
            </li>
            <li>Click <span class="fw-semibold">Save</span>.</li>
          </ol>

        </div>
      </div>
    </div>

    <div class="col-12 col-lg-6">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <div class="fw-semibold mb-2">Edit / Hide an Event</div>

          <ol class="mb-0">
            <li>Go to <span class="fw-semibold">Events</span>.</li>
            <li>Find the event and click <span class="fw-semibold">Edit</span>.</li>
            <li>Update date/time, venue, description, and image as needed.</li>
            <li>
              To remove it from the website without deleting, disable <span class="fw-semibold">Active</span>.
            </li>
            <li>Click <span class="fw-semibold">Save</span> / <span class="fw-semibold">Update</span>.</li>
          </ol>

          <hr class="my-3" />

          <div class="fw-semibold mb-2">Verify</div>
          <ul class="mb-0">
            <li>Open <span class="fw-semibold">View Website</span> → Events page.</li>
            <li>Confirm the event appears with the correct date/time and location.</li>
            <li>Open the event and confirm the banner image displays properly.</li>
          </ul>

        </div>
      </div>
    </div>

    <div class="col-12">
      <div class="card shadow-sm">
        <div class="card-body">
          <div class="fw-semibold mb-2">Common issues & fixes</div>

          <div class="accordion" id="eventsFaq">

            <div class="accordion-item">
              <h2 class="accordion-header" id="eventsFaq1h">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#eventsFaq1">
                  Event not showing on the website
                </button>
              </h2>
              <div id="eventsFaq1" class="accordion-collapse collapse show" data-bs-parent="#eventsFaq">
                <div class="accordion-body">
                  Confirm <span class="fw-semibold">Active</span> is enabled.
                  If the frontend filters by “upcoming only”, check that the event date is not in the past.
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header" id="eventsFaq2h">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#eventsFaq2">
                  Date/time appears incorrectly
                </button>
              </h2>
              <div id="eventsFaq2" class="accordion-collapse collapse" data-bs-parent="#eventsFaq">
                <div class="accordion-body">
                  Confirm the date and time are entered correctly in the form.
                  If timezones are used, ensure the system timezone matches your expected timezone.
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header" id="eventsFaq3h">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#eventsFaq3">
                  Banner image not displaying
                </button>
              </h2>
              <div id="eventsFaq3" class="accordion-collapse collapse" data-bs-parent="#eventsFaq">
                <div class="accordion-body">
                  Ensure the upload completed and you saved the event.
                  If the image is too large, compress it and upload again.
                  Confirm the frontend uses the correct image path.
                </div>
              </div>
            </div>

          </div>

        </div>
      </div>
    </div>

  </div>
</div>