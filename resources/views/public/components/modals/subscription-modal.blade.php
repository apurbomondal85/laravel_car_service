<div class="modal fade" id="subscriptionModal" tabindex="-1" aria-labelledby="subscriptionModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="subscriptionModalLabel">Subscription Form</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="contact-page-form mt-0">
          <form action="{{route('public.subscription.send')}}" class="pt-0" method="post" enctype="multipart/form-data">
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

            <div class="mb-3">
              <label for="job-title" class="form-label">Subscription Name</label>
              <div class="single-input-field">
                <input type="text" class="form-control" id="job-title" name="subscriptionName"
                  placeholder="Enter the Name of the Subscription" required>
              </div>
            </div>

            <div class="mb-3">
              <label for="description" class="form-label">Description</label>
              <div class="single-input-field">
                <textarea class="form-control" id="description" name="description" rows="5"></textarea>
                <div class="single-input-field">
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label for="picture2" class="form-label">Picture</label>
              <div class="input-group">
                <input type="file" class="form-control" id="picture2" name="image">
              </div>
              <div id="preview-container" class="mt-2">
                <img id="preview2" src="#" alt="Preview" style="max-width: 200px; max-height: 200px; display: none;">
              </div>
            </div>

            <div class="d-grid gap-2">
              <button class="btn btn-success border-radius-5 fw-bold" type="submit">Post</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>