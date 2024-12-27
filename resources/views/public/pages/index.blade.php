@extends('public.layouts.master')
@section('title', 'Home')
@section('home', 'active')
@section('content')

@include('public.components.responses.responses')

<main id="main">
    <!-- ======= Hero Section ======= -->
    @include('public.pages.landing.hero')
    <!-- End Hero Section -->

     <!-- ===== About Section ===== -->
        @include('public.pages.landing.about')
      <!-- ===== End About Section ===== -->

    <!-- ===== Services Section ===== -->
    @include('public.pages.landing.services')
    <!-- ===== End Services Section ===== -->

    <!-- ===== Blog Section ===== -->
    @include('public.pages.landing.blogs')
    <!-- ===== End Blog Section ===== -->

   <!-- ===== Why Us ====== -->
    @include('public.pages.landing.why-us')
   <!-- ===== End Why Us ====== -->

    <!-- ======= Contact Section ======= -->
    @include('public.pages.landing.contact')
    <!-- End Contact Section -->

</main><!-- End #main -->
@endsection