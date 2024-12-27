@extends('public.layouts.master')
@section('career', 'active')
@section('content')

<!-- banner start -->
<section class="banner2">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-12 align-self-center">
				<h1 class="title-text text-center text-white" data-animation="fadeInUp" data-delay=".5s">APPLY NOW</h1>
			</div>
		</div>
</section>
<!-- banner end -->

<div class="container mt-5">
    <h1>Job Application Form</h1>
    <form>
        <div class="mb-3">
            <label for="fullName" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="fullName" name="fullName" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="mb-3">
            <label for="resume" class="form-label">Upload Resume</label>
            <input type="file" class="form-control" id="resume" name="resume" accept=".pdf,.doc,.docx" required>
        </div>

        <div class="mb-3">
            <label for="coverLetter" class="form-label">Cover Letter</label>
            <textarea class="form-control" id="coverLetter" name="coverLetter" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label for="jobPosition" class="form-label">Job Position</label>
            <select class="form-select" id="jobPosition" name="jobPosition" required>
                <option value="" disabled selected>Select a job position</option>
                <option value="developer">Developer</option>
                <option value="designer">Designer</option>
                <option value="manager">Manager</option>
            </select>
        </div>

        <div class="mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="terms" name="terms" required>
                <label class="form-check-label" for="terms">
                    I agree to the <a href="#">terms and conditions</a>
                </label>
            </div>
        </div>

        <button type="submit" class="btn btn-success">Submit Application</button>
    </form>
</div>

@endsection