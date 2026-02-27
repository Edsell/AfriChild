<div class="d-flex align-items-center gap-2 mb-2">
  <i class="bx bx-user text-primary"></i>
  <h6 class="mb-0">Users</h6>
</div>

<div class="text-muted mb-3">
  The Users module manages MIS accounts (who can log in, what they can see/do, and whether the account is active).
  Access to menus and buttons is controlled by roles/permissions.
</div>

<div class="alert alert-warning d-flex align-items-start gap-2">
  <i class="bx bx-error-circle mt-1"></i>
  <div>
    <div class="fw-semibold">Permissions rule</div>
    <div>
      If a user says “I can’t see a menu/button”, it is usually a <span class="fw-semibold">role/permission</span> issue — not a system error.
      Update their role/permissions and ask them to log out and log in again.
    </div>
  </div>
</div>

<button class="btn btn-primary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#usersGuide">
  Open Users guide
</button>

<div class="collapse show mt-3" id="usersGuide">

  <div class="row g-3">

    <div class="col-12 col-lg-6">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <div class="fw-semibold mb-2">Create a new User</div>

          <ol class="mb-0">
            <li>Go to <span class="fw-semibold">Users</span> in the MIS sidebar.</li>
            <li>Click <span class="fw-semibold">Add New</span> / <span class="fw-semibold">Create User</span>.</li>
            <li>Fill in the required identity fields:
              <span class="fw-semibold">Name</span>,
              <span class="fw-semibold">Email/Username</span> (depending on your system),
              and <span class="fw-semibold">Phone</span> if required.
            </li>
            <li>
              Set the login credential fields:
              <span class="fw-semibold">Password</span> (or “Send invite/reset” if your system uses that flow).
            </li>
            <li>
              Assign the correct <span class="fw-semibold">Role</span> (examples: Admin, Content Manager, Programs, M&E, Finance).
            </li>
            <li>
              If your system uses granular permissions, select the required <span class="fw-semibold">Permissions</span>
              (menus/modules the user needs).
            </li>
            <li>Enable <span class="fw-semibold">Active</span> so the user can log in.</li>
            <li>Click <span class="fw-semibold">Save</span>.</li>
          </ol>

          <hr class="my-3" />

          <div class="fw-semibold mb-2">After creating</div>
          <ul class="mb-0">
            <li>Share login details securely (do not post passwords in group chats).</li>
            <li>Ask the user to log in and confirm they can see the modules they need.</li>
          </ul>
        </div>
      </div>
    </div>

    <div class="col-12 col-lg-6">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <div class="fw-semibold mb-2">Edit / Deactivate a User</div>

          <ol class="mb-0">
            <li>Go to <span class="fw-semibold">Users</span>.</li>
            <li>Find the user and click <span class="fw-semibold">Edit</span>.</li>
            <li>Update user details (name, email/username, phone).</li>
            <li>Update <span class="fw-semibold">Role</span> / <span class="fw-semibold">Permissions</span> if access needs change.</li>
            <li>
              To block access without deleting the account, disable <span class="fw-semibold">Active</span>.
            </li>
            <li>Click <span class="fw-semibold">Save</span> / <span class="fw-semibold">Update</span>.</li>
          </ol>

          <hr class="my-3" />

          <div class="fw-semibold mb-2">Reset password (common)</div>
          <ul class="mb-0">
            <li>If your user form has a password field: set a new password and save.</li>
            <li>If you have a “Reset password / Send reset link” feature: use it and tell the user to check email.</li>
            <li>After any role change, ask the user to log out and log in again.</li>
          </ul>

        </div>
      </div>
    </div>

    <div class="col-12">
      <div class="card shadow-sm">
        <div class="card-body">
          <div class="fw-semibold mb-2">Common issues & fixes</div>

          <div class="accordion" id="usersFaq">

            <div class="accordion-item">
              <h2 class="accordion-header" id="usersFaq1h">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#usersFaq1">
                  User cannot log in
                </button>
              </h2>
              <div id="usersFaq1" class="accordion-collapse collapse show" data-bs-parent="#usersFaq">
                <div class="accordion-body">
                  Confirm the account is <span class="fw-semibold">Active</span>.
                  If the password was changed, ensure the user is using the latest password or send a reset link.
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header" id="usersFaq2h">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#usersFaq2">
                  User can log in but cannot see a module/menu
                </button>
              </h2>
              <div id="usersFaq2" class="accordion-collapse collapse" data-bs-parent="#usersFaq">
                <div class="accordion-body">
                  Update the user’s <span class="fw-semibold">Role/Permissions</span>.
                  Then ask them to <span class="fw-semibold">log out and log back in</span>.
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header" id="usersFaq3h">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#usersFaq3">
                  Duplicate account / wrong email
                </button>
              </h2>
              <div id="usersFaq3" class="accordion-collapse collapse" data-bs-parent="#usersFaq">
                <div class="accordion-body">
                  Edit the existing user to correct the email/username.
                  If duplicates exist, deactivate the incorrect one instead of deleting (recommended for audit/history).
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

  </div>
</div>