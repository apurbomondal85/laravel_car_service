@extends('public.layouts.master')
@section('contact', 'active')
@section('breadTitle', 'Contact')
@section('title', 'Contact')
@section('content')

@include('public.components.responses.responses')
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    @include('public.components.breadcrumbs')

    <section id="contact" class="contact">
        <h6 class="bar top-title">Contact</h6>
        <div class="contact-section mt-4">
          <div class="container">
            <div class="contact-main">
              <div class="row">
                <div class="col-md-6">
                  <div class="contact-info">
                    <p class="form-text-subtitle">Serving your local area</p>
                    <h2 class="form-text-title">Home, Commercial, Auto, You Name It, We'll Be there.</h2>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-section">
                    <h3 class="form-title bar mb-2">Contact Us</h3>
                    <form>
                      <div class="mb-3">
                        <input type="text" class="" id="exampleInputEmail1" aria-describedby="emailHelp"
                          placeholder="Name">
                      </div>
                      <div class="mb-3">
                        <input type="email" class="" id="exampleInputEmail1" aria-describedby="emailHelp"
                          placeholder="Email">
                      </div>
                      <div class="mb-3">
                        <input type="password" class="" id="exampleInputPassword1" placeholder="Password">
                      </div>
                      <div class="mb-3">
                        <input type="text" class="" id="exampleInputEmail1" aria-describedby="emailHelp"
                          placeholder="Subjects">
                      </div>
                      <div class="mb-3">
                        <textarea class="textarea" placeholder="Comments"></textarea>
                      </div>
                      <button type="submit" class="btn btn-primary">Send <i
                          class="fa-solid fa-paper-plane p-1"></i></button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        </div>
      </section>

    <!-- ===== Contact Section ===== -->

</main><!-- End #main -->
@endsection