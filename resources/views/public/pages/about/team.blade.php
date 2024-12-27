@extends('public.layouts.master')
@section('about', 'active')
@section('breadTitle', 'Our Team')
@section('title', 'Team')
@section('content')

<main id="main">
    @include('public.components.breadcrumbs')

    @if(isset($teamMembers))
    <section id="team" class="team">
        <div class="container" data-aos="fade-up">
          <div class="row gy-4 px-xxl-5 mx-xxl-5">
            @foreach ($teamMembers as $member)
            <div class="col-lg-3 col-md-6">
                <div class="team-card d-flex flex-column align-items-center gap-lg-3 gap-2 position-relative">
                    <div class="team-sha position-absolute"></div>
                    <div class="team-img">
                        <img src="{{ $member->user->getAvatar() }}" alt="">
                    </div>
                    <div class="text-center">
                        <h3>{{ $member->user->full_name }}</h3>
                        <p>{{ $member->team_designation }}</p>
                    </div>
                </div>
            </div>
            @endforeach
          </div>
        </div>
      </section>
    @else
    <section>
        <div class="container mb-3">
            <div class="row">
                <div class="card shadow-sm border-radius-5">
                    <div class="card-body">
                        <div class="col-md-12 text-center">
                            <h2 data-aos="zoom-in" data-aos-duration="3000" class="aos-init aos-animate text-danger"
                                style="padding: 50px;">
                                OPPS! Team not found...
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

</main>
@endsection