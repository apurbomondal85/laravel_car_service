<div class="modal fade" id="contactUsModal" tabindex="-1" aria-labelledby="contactUsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="contactUsModalLabel">Write Us</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="contact-page-form mt-0">
          <form action="{{route('public.contact.message')}}" class="pt-0" method="post">
            @csrf
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="single-input-field">
                  <input type="text" placeholder="Your Name" name="name"
                    class="@error('name') border border-danger @enderror" required />
                </div>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="single-input-field">
                  <input type="email" placeholder="E-mail" name="email"
                    class="@error('email') border border-danger @enderror" required />
                </div>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="single-input-field">
                  <input type="text" placeholder="Phone Number" name="phone"
                    class="@error('phone') border border-danger @enderror" />
                </div>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="single-input-field">
                  <input type="text" placeholder="Subject" name="subject"
                    class="@error('subject') border border-danger @enderror" />
                </div>
              </div>
              <div class="col-md-12 message-input">
                <div class="single-input-field">
                  <textarea placeholder="Write Your Message" name="message"
                    class="@error('message') border border-danger @enderror"></textarea>
                </div>
              </div>

            </div>
            <div class="single-input-fieldsbtn text-center">
              <input type="submit" value="Send Now" />
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>