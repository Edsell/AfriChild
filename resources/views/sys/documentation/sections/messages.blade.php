<div class="d-flex align-items-center gap-2 mb-2">
  <i class="bx bx-envelope text-primary"></i>
  <h6 class="mb-0">Messages</h6>
</div>

<div class="text-muted mb-3">
  The Messages module collects inquiries sent through the website (Contact form). Use it to read, follow up, and track handled messages.
</div>

<div class="alert alert-primary d-flex align-items-start gap-2">
  <i class="bx bx-bulb mt-1"></i>
  <div>
    <div class="fw-semibold">Good practice</div>
    <div>
      Always reply using the organization email and keep internal notes (if your system supports them).
      Mark messages as handled once completed to avoid duplicate responses.
    </div>
  </div>
</div>

<button class="btn btn-primary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#messagesGuide">
  Open Messages guide
</button>

<div class="collapse show mt-3" id="messagesGuide">

  <div class="row g-3">

    <div class="col-12 col-lg-6">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <div class="fw-semibold mb-2">Read and respond to a message</div>

          <ol class="mb-0">
            <li>Go to <span class="fw-semibold">Messages</span> in the MIS sidebar.</li>
            <li>
              Use the list to identify new/unread messages (often highlighted or marked with a badge).
            </li>
            <li>Click <span class="fw-semibold">View</span> / open the message to read full details.</li>
            <li>Note the sender’s <span class="fw-semibold">Name</span>, <span class="fw-semibold">Email</span>, and <span class="fw-semibold">Message</span>.</li>
            <li>
              Reply using the official organization email (copy the sender’s email address).
              <div class="small text-muted mt-1">
                MIS usually stores messages but does not always send replies automatically unless a “Reply” feature is implemented.
              </div>
            </li>
            <li>
              After replying, mark the message as <span class="fw-semibold">Handled/Resolved</span> or <span class="fw-semibold">Read</span>
              if your module provides that action.
            </li>
          </ol>

        </div>
      </div>
    </div>

    <div class="col-12 col-lg-6">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <div class="fw-semibold mb-2">Organize and track messages</div>

          <ol class="mb-0">
            <li>Use search/filter (if available) to find messages by name/email/date.</li>
            <li>For repeated inquiries, create a standard reply template for faster responses.</li>
            <li>
              If your module supports it:
              <ul class="mt-1">
                <li>Add internal notes (e.g., “Forwarded to Programs team”).</li>
                <li>Set status (New → In Progress → Resolved).</li>
                <li>Archive old items instead of deleting (recommended).</li>
              </ul>
            </li>
            <li>
              Only delete messages if required by policy, because deletion removes history.
            </li>
          </ol>

          <hr class="my-3" />

          <div class="fw-semibold mb-2">Verify</div>
          <ul class="mb-0">
            <li>Confirm the message status updates correctly (read/handled) after your action.</li>
            <li>Confirm your reply was sent (check Sent mail in the official inbox).</li>
          </ul>

        </div>
      </div>
    </div>

    <div class="col-12">
      <div class="card shadow-sm">
        <div class="card-body">
          <div class="fw-semibold mb-2">Common issues & fixes</div>

          <div class="accordion" id="messagesFaq">

            <div class="accordion-item">
              <h2 class="accordion-header" id="messagesFaq1h">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#messagesFaq1">
                  Messages are not appearing
                </button>
              </h2>
              <div id="messagesFaq1" class="accordion-collapse collapse show" data-bs-parent="#messagesFaq">
                <div class="accordion-body">
                  Confirm the website contact form is enabled and pointing to the correct endpoint.
                  Also check your permissions (some roles may not see Messages).
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header" id="messagesFaq2h">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#messagesFaq2">
                  I clicked “View” but cannot mark as handled
                </button>
              </h2>
              <div id="messagesFaq2" class="accordion-collapse collapse" data-bs-parent="#messagesFaq">
                <div class="accordion-body">
                  You may not have the permission to update message status.
                  Ask an Admin to grant access or handle it using an Admin account.
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header" id="messagesFaq3h">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#messagesFaq3">
                  Spam messages
                </button>
              </h2>
              <div id="messagesFaq3" class="accordion-collapse collapse" data-bs-parent="#messagesFaq">
                <div class="accordion-body">
                  Mark as spam/ignore if supported. If spam increases, enable CAPTCHA on the contact form
                  and consider rate limiting.
                </div>
              </div>
            </div>

          </div>

        </div>
      </div>
    </div>

  </div>
</div>