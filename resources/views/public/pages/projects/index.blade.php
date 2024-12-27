@extends('public.layouts.master')
@section('title', 'Projects')
@section('project', 'active')
@section('breadTitle', 'Our Projects')
@section('content')

<main id="main">

    @foreach($projects as $project)
    <section id="residential" class="residential">
        <div class="container mb-3">
            <div class="row">
                <div class="card shadow-sm border-radius-5">
                    <div class="card-body px-lg-4">
                        <div>
                            <h2 data-aos="zoom-in" data-aos-duration="1000" class="text-center">{{ $project->name }}</h2>
                            <hr>
                            <p>{{ $project->short_description }}</p>
                            <p>{!! $project->description !!}</p>
                        </div>

                        <div class="row mt-4 gy-3">

                        @foreach($project->projectImages as $img)
                            <div class="col-md-4 p-lg-5">
                                <img src="{{ $img->getProjectImage() }}"
                                    alt="project-images" class="project-img img-fluid rounded-4"
                                    onclick="clickImage('{{ $img->id }}', '{{ $project->projectImages }}')">
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endforeach
</main>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center showImage">
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function clickImage(id, images) {
        $carousel_item ='';
        
        console.log(JSON.parse(images));
        $.each(JSON.parse(images) , function(index, val) { 
        if(id == val.id){
            $active = 'active';
        }else{
            $active='';
        }
            $src = BASE_URL+'/'+val.image;
            $carousel_item += '<div class="carousel-item '+$active+'" data-bs-interval="1000000">'+
            ' <img src="'+$src+'" class="d-block w-100" alt="...">'+
            ' </div>';
            
        });
        $(".carousel-inner").html($carousel_item);
        $('#staticBackdrop').modal('show');
    }
</script>
@endpush