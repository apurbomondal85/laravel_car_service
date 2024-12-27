@extends('public.layouts.master')
@section('about', 'active')
@section('breadTitle', 'Our Blogs')
@section('title', 'Blogs')

@section('content')

<main id="main">

    @include('public.components.breadcrumbs')

    <section id="blogs" class="blogs">
      <div class="container">
        <h6 class="bar top-title">Blogs</h6>
        <div class="row">
          <div class="d-flex gap-4 mt-4">
            <div class="card">
              <div class="blogs-content">
                <img src="./asset/images/blogs/blogs-1.webp" class="" alt="car service blogs image">
              </div>
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                  <p class="card-date"><i class="fa-regular fa-clock text-danger p-lg-1 fs-5"></i> 08-5-2020</p>
                  <div>
                    <img class="blog-logo" src="./asset/images/team/team-img-1.webp" alt="car service blogs-logo image">
                  </div>
                </div>
                <div class="blog-text">
                  <h3 class="blogs-title">Henry</h3>
                  <p class="blogs-subtitle">Lorem ipsum dolor</p>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="blogs-content">
                <img src="./asset/images/blogs/blogs-2.webp" class="" alt="car service blogs image">
              </div>
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                  <p class="card-date"><i class="fa-regular fa-clock text-danger p-lg-1 fs-5"></i> 08-5-2020</p>
                  <div>
                    <img class="blog-logo" src="./asset/images/team/team-img-1.webp" alt="car service blogs-logo image">
                  </div>
                </div>
                <h3 class="blogs-title">Thomas</h3>
                <p class="blogs-subtitle">Lorem ipsum dolor sit amet. Lorem ipsum dolor.</p>
              </div>
            </div>
            <div class="card">
              <div class="blogs-content">
                <img src="./asset/images/blogs/blogs-3.webp" class="" alt="car service blogs image">
              </div>
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                  <p class="card-date"><i class="fa-regular fa-clock text-danger p-lg-1 fs-5"></i> 08-5-2020</p>
                  <div>
                    <img class="blog-logo" src="./asset/images/team/team-img-1.webp" alt="car service blogs-logo image">
                  </div>
                </div>
                <h3 class="blogs-title">Charlotte</h3>
                <p class="blogs-subtitle">Lorem ipsum dolor sit amet. Lorem ipsum dolor.</p>
              </div>
            </div>
            <div class="card">
              <div class="blogs-content">
                <img src="./asset/images/blogs/blogs-4.webp" class="" alt="car service blogs image">
              </div>
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                  <p class="card-date"><i class="fa-regular fa-clock text-danger p-lg-1 fs-5"></i> 08-5-2020</p>
                  <div>
                    <img class="blog-logo" src="./asset/images/team/team-img-1.webp" alt="car service blogs-logo image">
                  </div>
                </div>
                <h3 class="blogs-title">Elizabeth</h3>
                <p class="blogs-subtitle">Lorem ipsum dolor sit amet. Lorem ipsum dolor.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section> 

</main><!-- End #main -->
@stop