@extends('public.layouts.master')
@section('about', 'active')
@section('breadTitle', 'About Us')
@section('title', 'About')
@section('content')

<main id="main">

<!-- ======= Breadcrumbs ======= -->
@include('public.components.breadcrumbs')
<!-- End Breadcrumbs -->


 <!-- ===== About Section ===== -->
 <section id="about" class="about" style="background-image: url('{{ asset('frontend/image/about-img.webp') }}'); background-size: cover;">
    <div class="section-header">
      <h2>About Us</h2>
    </div>
    <div class="container" data-aos="zoom-out">
      <div class="about-card mt-lg-5 mt-4">
        <div class="row gy-lg-0 gy-4">
          <div class="col-lg-6">
            <div class="about-img">
              <img src="{{ asset('frontend/image/about-img.webp') }}" class="img-fluid rounded-4" alt="">
            </div>
          </div>
          <div class="col-lg-6">
            <div class="about-text">
              <h4>About us</h4>
              <h2>Welcome to Bangla Construction Limited.</h2>
              <p>Bangla Construction Limited. is a premier construction and renovation firm specialising in delivering top-notch services tailored to meet diverse client needs. With a strong commitment to quality, innovation, and customer satisfaction, we pride ourselves on our ability to transform spaces with precision and excellence..</p>
              <p>At Bangla Construction Limited., our mission is to transform spaces into functional and aesthetically pleasing environments that exceed expectations. From residential homes to commercial establishments, our dedicated team ensures each project is executed with precision and attention to detail, ensuring unparalleled results that stand the test of time. Trust Bangla Construction Limited. to bring your vision to life with integrity, reliability, and unparalleled expertise.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ===== End About Section ===== -->

</main><!-- End #main -->
@endsection
