<div class="modal fade" id="jobPostModal" tabindex="-1" aria-labelledby="jobPostModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="jobPostModalLabel">Get a Free Quote</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="contact-page-form mt-0">
          <form action="{{route('public.job.send')}}" class="pt-0" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <div class="single-input-field">
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
              </div>
            </div>

            <div class="mb-3">
              <label for="address" class="form-label">Address</label>
              <div class="single-input-field">
                <input type="text" class="form-control" id="address" name="address" placeholder="Enter your address" required>
              </div>
            </div>

            <div class="mb-3">
              <label for="mobile" class="form-label">Mobile</label>
              <div class="single-input-field">
                <input type="tel" class="form-control" id="mobile" name="mobile" placeholder="Enter your mobile number" required>
              </div>
            </div>

            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <div class="single-input-field">
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email address" required>
              </div>
            </div>

            {{-- <div class="mb-3">
              <label for="job-title" class="form-label">Job Title</label>
              <div class="single-input-field">
                <input type="text" class="form-control" id="job-title" name="jobTitle"
                  placeholder="Enter the job title" required>
              </div>
            </div> --}}

            <div class="mb-3">
              <label for="details" class="form-label">Details</label>
              <div class="single-input-field">
                <textarea class="form-control" id="details" name="details" rows="5"
                  placeholder="Enter job details"></textarea>
                <div class="single-input-field">
                </div>
              </div>
            </div>

            {{-- <div class="mb-3">
              <label for="picture" class="form-label">Picture</label>
              <div class="input-group">
                <input type="file" class="form-control" id="picture" name="image" accept="image/*">
              </div>
              <div id="preview-container" class="mt-2">
                <img id="preview" src="#" alt="Preview" style="max-width: 200px; max-height: 200px; display: none;">
              </div>
            </div> --}}

            <div class="d-grid gap-2">
              <button class="btn btn-success border-radius-5 fw-bold" type="submit">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
