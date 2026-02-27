<div class="d-flex align-items-center gap-2 mb-2">
  <i class="bx bx-news text-primary"></i>
  <h6 class="mb-0">Blog</h6>
</div>

<div class="text-muted mb-3">
  The Blog module publishes news, stories, and updates to the website’s Blog/News section.
  Each post typically includes a title, featured image, short summary (excerpt), full content, and publish status.
</div>

<div class="alert alert-primary d-flex align-items-start gap-2">
  <i class="bx bx-bulb mt-1"></i>
  <div>
    <div class="fw-semibold">Content tip</div>
    <div>
      Use a short <span class="fw-semibold">Excerpt</span> for previews and a clean <span class="fw-semibold">Featured Image</span>.
      Keep paragraphs short for readability on mobile.
    </div>
  </div>
</div>

<button class="btn btn-primary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#blogGuide">
  Open Blog guide
</button>

<div class="collapse show mt-3" id="blogGuide">

  <div class="row g-3">

    <div class="col-12 col-lg-6">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <div class="fw-semibold mb-2">Create a Blog Post</div>

          <ol class="mb-0">
            <li>Go to <span class="fw-semibold">Blog</span> in the MIS sidebar.</li>
            <li>Click <span class="fw-semibold">Add New</span> / <span class="fw-semibold">Create Post</span>.</li>
            <li>Enter <span class="fw-semibold">Title *</span>.</li>
            <li>
              Enter <span class="fw-semibold">Excerpt / Summary</span> (short preview text shown in blog lists).
            </li>
            <li>
              Upload <span class="fw-semibold">Featured Image</span> (recommended: clear, high quality, web-optimized).
            </li>
            <li>
              Write the main <span class="fw-semibold">Content / Body</span>.
              <div class="small text-muted mt-1">
                If you’re using a rich editor, avoid pasting from Word with heavy formatting.
              </div>
            </li>
            <li>
              (Optional) Set <span class="fw-semibold">Category</span>, <span class="fw-semibold">Tags</span>, and/or <span class="fw-semibold">Author</span> if your form includes them.
            </li>
            <li>
              (Optional) Set <span class="fw-semibold">Publish Date</span> if your system supports scheduling.
            </li>
            <li>
              Fill SEO fields if present:
              <span class="fw-semibold">Meta Title</span>,
              <span class="fw-semibold">Meta Keywords</span>,
              <span class="fw-semibold">Meta Description</span>.
            </li>
            <li>
              Ensure <span class="fw-semibold">Active / Published</span> is enabled if you want it visible on the website.
            </li>
            <li>Click <span class="fw-semibold">Save</span>.</li>
          </ol>

        </div>
      </div>
    </div>

    <div class="col-12 col-lg-6">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <div class="fw-semibold mb-2">Edit / Unpublish a Post</div>

          <ol class="mb-0">
            <li>Go to <span class="fw-semibold">Blog</span>.</li>
            <li>Find the post and click <span class="fw-semibold">Edit</span>.</li>
            <li>Update title, content, excerpt, image, or SEO fields.</li>
            <li>
              To hide the post, disable <span class="fw-semibold">Active / Published</span>.
            </li>
            <li>Click <span class="fw-semibold">Save</span> / <span class="fw-semibold">Update</span>.</li>
          </ol>

          <hr class="my-3" />

          <div class="fw-semibold mb-2">Verify</div>
          <ul class="mb-0">
            <li>Open <span class="fw-semibold">View Website</span> → Blog/News page.</li>
            <li>Confirm the post appears (or is hidden if inactive).</li>
            <li>Open the post and confirm the image + formatting look correct.</li>
          </ul>

        </div>
      </div>
    </div>

    <div class="col-12">
      <div class="card shadow-sm">
        <div class="card-body">
          <div class="fw-semibold mb-2">Common issues & fixes</div>

          <div class="accordion" id="blogFaq">

            <div class="accordion-item">
              <h2 class="accordion-header" id="blogFaq1h">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#blogFaq1">
                  Post not showing on the website
                </button>
              </h2>
              <div id="blogFaq1" class="accordion-collapse collapse show" data-bs-parent="#blogFaq">
                <div class="accordion-body">
                  Confirm <span class="fw-semibold">Active / Published</span> is enabled.
                  If there is a <span class="fw-semibold">Publish Date</span>, make sure it is not set to a future date.
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header" id="blogFaq2h">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#blogFaq2">
                  Formatting looks broken after paste
                </button>
              </h2>
              <div id="blogFaq2" class="accordion-collapse collapse" data-bs-parent="#blogFaq">
                <div class="accordion-body">
                  Paste as plain text first, then add minimal formatting (headings, lists).
                  Remove extra spaces/line breaks.
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header" id="blogFaq3h">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#blogFaq3">
                  Featured image not displaying
                </button>
              </h2>
              <div id="blogFaq3" class="accordion-collapse collapse" data-bs-parent="#blogFaq">
                <div class="accordion-body">
                  Ensure the image upload completed and you saved the post.
                  If the image is too large, compress it and upload again.
                  Confirm the frontend path resolves correctly.
                </div>
              </div>
            </div>

          </div>

        </div>
      </div>
    </div>

  </div>
</div>