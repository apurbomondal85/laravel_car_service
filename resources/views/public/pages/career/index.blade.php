@extends('public.layouts.master')
@section('career', 'active')
@section('content')

<!-- banner start -->
<section class="banner2">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-12 align-self-center">
				<h1 class="title-text text-center text-white" data-animation="fadeInUp" data-delay=".5s">CAREERS</h1>
			</div>
		</div>
</section>
<!-- banner end -->


<section class="career">
	<div class="container">
		<div class="row">
			@foreach ($careers as $career)
			<div class="col-md-6">
				<div class="card">
					<h3 class="mt-0 mb-3">{{$career->title}}</h3>
					<div><div class="icon-wrapper"><i class="fa-solid fa-briefcase"></i></div><p>{{$career->job_type}}</p></div> 
					<div><div class="icon-wrapper"><i class="fa-solid fa-book"></i></div><p>{{$career->company_name}}</p></div> 
					<div><div class="icon-wrapper"><i class="fa-solid fa-location-dot"></i></div><p>{{$career->location}}</p></div> 
					<div><div class="icon-wrapper"><i class="fa-solid fa-clock"></i></div><p>{{$career->deadline}}</p></div> 
					<div><div class="icon-wrapper"><i class="fa-solid fa-file-prescription"></i></div><p>{{$career->short_description}}</p></div> 
					<div class="d-flex justify-content-end">
						<a class="btn-c mt-3" target="_blank" href="{{route('public.careerDetails',$career->id)}}">Details</a>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</section>



@endsection