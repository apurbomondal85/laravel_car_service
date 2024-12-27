<section id="contact" class="contact">
    <div class="container" data-aos="fade-up">
        <div class="row gx-lg-0 gy-4">

            <div class="col-lg-4">
                <div class="info-item d-flex">
                    <i class="bi bi-phone flex-shrink-0"></i>
                    <div>
                        <h4>Mobile</h4>
                        <p>{{ settings('phone') ? settings('phone') : '212534213' }}</p>
                        <p>{{ settings('phone2') ? settings('phone2') : '0212534213' }}</p>
                    </div>
                </div><!-- End Info Item -->
                <div class="info-item d-flex">
                    <i class="bi bi-envelope flex-shrink-0"></i>
                    <div>
                        <h4>Email</h4>
                        <p>{{ settings('email') ? settings('email') : 'info@banglaconstruction.co.nz' }}</p>
                    </div>
                </div><!-- End Info Item -->
                <div class="d-flex flex-column align-items-center justify-content-center">
                    <div class="info-item d-flex">
                        <i class="bi bi-envelope flex-shrink-0"></i>
                        <div>
                            <h4>Location</h4>
                            {{ settings('address') ? settings('address') : '463 Porchester Road, Randwick Park, Auckland
                            2105' }}
                        </div>
                    </div><!-- End Info Item -->
                    <div class="info-item d-flex">
                        <i class="bi bi-clock flex-shrink-0"></i>
                        <div>
                            <h4>Open Hours</h4>
                            <p>Hours 9-5 Mon-Fri</p>
                        </div>
                    </div><!-- End Info Item -->
                </div>
            </div>

            <div class="col-lg-8">
                <form method="post" action="{{ route('public.contact.store') }}" class="contact-form"
                    enctype="multipart/form-data">
                    @csrf
                    @if (count($errors) > 0)
                    @foreach ($errors->all() as $error)
                    <p class="alert alert-danger">{{ $error }}</p>
                    @endforeach
                    @endif
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="name"
                                class="@error('name') border border-danger @enderror" placeholder="Your Name*" required>
                            @error('name')
                            <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group mt-3 mt-md-0">
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}" id="email"
                                class="@error('email') border border-danger @enderror" placeholder="Email*" required>
                            @error('email')
                            <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-6 form-group">
                            <input type="tel" name="phone" value="{{ old('phone') }}"
                                class="form-control @error('phone') border border-danger @enderror" id="phone"
                                placeholder="Phone Number*" required>
                            @error('phone')
                            <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <textarea class="form-control" name="message" rows="7"
                            placeholder="Message">{{ old('message') }}</textarea>
                        @error('message')
                        <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="my-3">
                        <div class="loading">Loading</div>
                        <div class="error-message"></div>
                        <div class="sent-message">Your message has been sent. Thank you!</div>
                    </div>
                    <div><button type="submit">Submit</button></div>
                </form>
            </div><!-- End Contact Form -->

        </div>

    </div>
</section>