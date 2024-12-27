@extends('public.layouts.master')
@section('about', 'active')
@section('breadTitle', 'Blog Details')
@section('title', 'Blog Details')

@section('content')

<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    @include('public.components.breadcrumbs')

    <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">

            <div class="row g-5">

                <div class="col-lg-8">

                    <article class="blog-details">

                        @if(isset($blog->featured_image))
                        <div class="post-img" style="text-align: center;">
                            <img src="{{ asset( isset($blog->featured_image) ? $blog->featured_image : \App\Library\Enum::NO_IMAGE_PATH) }}"
                                alt="" class="w-100 h-100">
                        </div>
                        @endif

                        <h2 class="title">{{ isset($blog->title) ? $blog->title : 'N/A' }}</h2>

                        <div class="meta-top">
                            <ul>
                                <li class="d-flex align-items-center">
                                    <i class="bi bi-person"></i>
                                    <a href="#"> {{ $blog->operator?->full_name }}</a>
                                </li>
                                <li class="d-flex align-items-center">
                                    <i class="bi bi-clock"></i>
                                    <a href="#"><time datetime="2020-01-01"> {{ $blog->created_at->format('M d, Y')}}
                                        </time></a>
                                </li>
                            </ul>
                        </div>

                        <div class="content">
                            {!! $blog->description !!}
                        </div>

                        {{-- <div class="meta-bottom mt-3">
                            <i class="bi bi-folder"></i>
                            <ul class="cats">
                                <li><a href="#">Business</a></li>
                            </ul>

                            <i class="bi bi-tags"></i>
                            <ul class="tags">
                                <li><a href="#">Creative</a></li>
                                <li><a href="#">Tips</a></li>
                                <li><a href="#">Marketing</a></li>
                            </ul>
                        </div> --}}

                    </article>

                </div>

                <div class="col-lg-4">

                    <div class="sidebar">

                        <div class="sidebar-item categories">
                            <h3 class="sidebar-title">Types</h3>

                            <ul class="mt-3">
                                @foreach($categories as $key => $blog_category)
                                <li><a href="{{ route('public.blogCategoryWise', $key ) }}">{{ $key }}<span>({{ $blog_category }})</span></a></li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="sidebar-item recent-posts">
                            <h3 class="sidebar-title">Recent Posts</h3>

                            <div class="mt-3">
                                @foreach($blogs as $recent)
                                 <div class="mt-3 d-flex gap-3">
                                    <img src="{{ $recent->getFeaturedImage() }}" alt="">
                                    <div>
                                        <h4 class="ms-0">
                                            <a href="{{ route('public.blogDetails', $recent->id ) }}">
                                                {{ $recent->title }} </a>
                                        </h4>
                                        <time class="ms-0" datetime="2020-01-01">{{ $recent->created_at->format('M d, Y')}}</time>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                        </div>

                        @if(isset($tags))
                        <div class="sidebar-item tags">
                            <h3 class="sidebar-title">Tags</h3>
                            <ul class="mt-3">

                                @foreach ($tags as $tag)
                                <li><a href="#">{{ $tag }}</a></li>
                                @endforeach

                            </ul>
                        </div>
                        @endif

                    </div>

                </div>

            </div>

        </div>
    </section>

</main><!-- End #main -->
@stop

@push('scripts')

@endpush