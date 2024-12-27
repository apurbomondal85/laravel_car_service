@extends('public.layouts.master')
@section('title', '|| Subscriptions')
@section('subscription', 'active')
@section('content')
<!-- banner start -->
<section class="banner2">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="title-text text-center text-white" data-animation="fadeInUp" data-delay=".5s">Subscriptions
                </h1>
            </div>
        </div>
</section>
<!-- banner end -->
@include('public.components.responses.responses')
<!-- Section-7 -->
<section class="subscriptions">
    <div class="container mb-5">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <h2 class="title-text">Subscription 1</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis aperiam aut cupiditate eaque
                    veritatis asperiores incidunt voluptatum aliquid, vitae minima iure odit ex tenetur quae iusto
                    nobis ad praesentium aspernatur? </p>
                <ul class="list-group mt-3">
                    <li class="list-group-item grow fs-5"><i class="fas fa-hand-point-right"></i> Opputunity1
                        Opputunity1 Opputunity1 Opputunity1 Opputunity1 </li>
                    <li class="list-group-item grow fs-5"><i class="fas fa-hand-point-right"></i> Feature1 Feature1
                        Feature1 Feature1 Feature1 Feature1 Feature1
                        in
                    </li>
                    <li class="list-group-item grow fs-5"><i class="fas fa-hand-point-right"></i>Benifits1</li>
                    <li class="list-group-item grow fs-5"><i class="fas fa-hand-point-right"></i> Salary
                        ac
                    </li>
                    <li class="list-group-item grow fs-5"><i class="fas fa-hand-point-right"></i> Vacations Vacations
                        Vacations Vacations Vacations Vacations Vacations
                    </li>
                </ul>
                <button class="btn btn-success border-radius-5 fw-bold my-3" data-bs-toggle="modal"
                    data-bs-target="#subscriptionModal">Buy Now</button>
            </div>

            <div class="offset-lg-1 o-1 col-lg-5 col-md-6 text-center">
                <div class="featured p-4 ">
                    <img src="{{asset('images/banner2.jpg')}}" alt="img">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section-8 -->
<section class="subscriptions">
    <div class="container mb-5">
        <div class="row">
            <div class="o-1 col-lg-5 col-md-6 text-center">
                <div class="featured p-4">
                    <img src="{{asset('images/contact-banner.jpg')}}" alt="img">
                </div>
            </div>
            <div class="col-lg-5 offset-lg-2 col-md-5 pl-5">
                <h2 class="title-text">Subscription 2</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis aperiam aut cupiditate eaque
                    veritatis asperiores incidunt voluptatum aliquid, vitae minima iure odit ex tenetur quae iusto
                    nobis ad praesentium aspernatur? </p>
                <ul class="list-group mt-3">
                    <li class="list-group-item grow fs-5"><i class="fas fa-hand-point-right"></i> Opputunity1
                        Opputunity1 Opputunity1 Opputunity1 Opputunity1 </li>
                    <li class="list-group-item grow fs-5"><i class="fas fa-hand-point-right"></i> Feature1 Feature1
                        Feature1 Feature1 Feature1 Feature1 Feature1
                        in
                    </li>
                    <li class="list-group-item grow fs-5"><i class="fas fa-hand-point-right"></i>Benifits1</li>
                    <li class="list-group-item grow fs-5"><i class="fas fa-hand-point-right"></i> Salary
                        ac
                    </li>
                    <li class="list-group-item grow fs-5"><i class="fas fa-hand-point-right"></i> Vacations Vacations
                        Vacations Vacations Vacations Vacations Vacations
                    </li>
                </ul>
                <button class="btn btn-success border-radius-5 fw-bold my-3" data-bs-toggle="modal"
                    data-bs-target="#subscriptionModal">Buy Now</button>
            </div>

        </div>
    </div>
</section>
@include('public.components.modals.subscription-modal')
@endsection