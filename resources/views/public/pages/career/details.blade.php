@extends('public.layouts.master')
@section('career', 'active')
@section('content')

<!-- banner start -->
<section class="banner2">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-12 align-self-center">
				<h1 class="title-text text-center text-white" data-animation="fadeInUp" data-delay=".5s">JOB DETAILS</h1>
			</div>
		</div>
</section>
<!-- banner end -->

<div class="">
<div class="container">
    <div class="row">
        <h2 class="text-center mt-4">{{$career->title}}</h2>
    </div>
    <div class="row">
        <div class="container mt-5">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td><b>Job Id:</b> {{$career->id}}</td>
                        <td><b>Job Type:</b> {{$career->job_type}}</td>
                        <td><b>Job Title:</b> {{$career->title}}</td>
                        <td><b>Deadline:</b> {{$career->deadline}}</td>
                    </tr>
                    <tr>
                        <td><b>Location:</b> {{$career->location}}</td>
                        <td><b>Operator:</b> {{$career->operator_id}}</td>
                        <td><b>Company:</b> {{$career->company_name}}</td>
                        <td><b>Post date:</b> {{$career->created_at}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    
    </div>
    <div class="row">
        <h3 class="my-4">JOB CONTEXT:</h3>
    </div>
    <div class="row">
        <p>{!! $career->description !!}</p>
    </div>
    {{-- <div class="row">
        <div class="d-flex mt-5">
            <a class="btn-d mt-3" href="{{route('public.apply',$career->id)}}">Apply Now</a>
        </div>
    </div> --}}
</div>

</div>

@endsection