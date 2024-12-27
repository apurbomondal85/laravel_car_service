@extends('public.layouts.master')
@section('media', 'active')
@section('content')

<section class="banner2">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="title-text text-center text-white" data-animation="fadeInUp" data-delay=".5s">Gallery</h1>
            </div>
        </div>
</section>

@include('public.components.responses.responses')


@if(count($galleries))

@foreach($galleries as $gallery)
    <section>
        <div class="container my-3">
            <div class="row">
                <div class="card shadow-sm border-radius-5">
                    <div class="card-body p-0">
                        <div class="col-md-12 text-center">
                            <h2 data-aos="zoom-in" data-aos-duration="3000" class="aos-init aos-animate">
                                {{ $gallery->name }}
                            </h2>
                            <hr>
                            <p class="conet-text">{{ $gallery->short_description }}</p>
                            <p class="conet-text">{!! $gallery->description !!}</p>
                        </div>

                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">

                            @foreach($gallery->galleryImages as $data)
                                <div class="col py-3 gallery">
                                    <img src="{{ asset($data->getgalleryImage()) }}" alt="gallery-images" class="g-img border-radius-5"
                                    onclick="clickImage('{{ $data->getgalleryImage() }}')" id="imageSrc">
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center showImage">
                    <img src="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>


@endforeach

@else

<section>
    <div class="container mb-3">
        <div class="row">
            <div class="card shadow-sm border-radius-5">
                <div class="card-body">
                    <div class="col-md-12 text-center">
                        <h2 data-aos="zoom-in" data-aos-duration="3000" class="aos-init aos-animate text-danger" style="padding: 50px;">
                            OPPS! Gallery not found...
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endif


@endsection

@push('scripts')
    <script>
        function clickImage(image) {
            $('#staticBackdrop').modal('show');
            $(".showImage img").attr("src", image);
        }
    </script>
@endpush
