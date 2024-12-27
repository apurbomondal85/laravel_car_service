@extends('public.layouts.master')
@section('about', 'active')
@section('title', 'Blogs')
@section('content')

<section class="banner2">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="title-text text-center text-white" data-animation="fadeInUp" data-delay=".5s">MEET OUR
                    CLIENTS</h1>
            </div>
        </div>
</section>

@include('public.components.responses.responses')

@if(isset($clients))
<div class="container mt-5">
    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 row-cols-xxl-6">
        @foreach($clients as $client)
        <div class="col">
            <div class="item">
                <div class="text-center my-2 d-flex justify-content-center">
                    <div class="circle-container">
                        <img src="{{ $client->getLogo() }}" alt="Logo" class="client-logo">
                        <h5 class="mt-2">{{ $client?->name }}</h5>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

</div>

@else
<section>
    <div class="container mb-3">
        <div class="row">
            <div class="card shadow-sm border-radius-5">
                <div class="card-body">
                    <div class="col-md-12 text-center">
                        <h2 data-aos="zoom-in" data-aos-duration="3000" class="aos-init aos-animate text-danger"
                            style="padding: 50px;">
                            OPPS! Client not found...
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

@endsection