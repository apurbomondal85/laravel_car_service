@extends('admin.layouts.master')

@section('title', __('New Gallery Image'))

@section('content')
<div class="content-wrapper">

    <div class="content-header d-flex justify-content-start">
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper(__('New Gallery Image')) }}</h4>
        </div>
        {!! \App\Library\Html::linkBack(route('admin.gallery.index')) !!}
    </div>

    <form method="post" id="create-form" action="{{ route('admin.gallery.storeGalleryImage', $gallery->id) }}" enctype="multipart/form-data">
        @csrf
        <div class="card col-md-12" style="box-shadow: rgb(0, 92, 45) 0px 2px 5px !important;">
            <div class="card-body">

                @include('admin.pages.partial.create')

                <div class="row">
                    <div class="modal-footer justify-content-center col-md-12">

                        {!! \App\Library\Html::btnReset() !!}

                        <button type="submit" class="btn mr-3 my-3 btn2-secondary d-none" id="subBtnFinal">
                            <i class="fas fa-save"></i> Save
                        </button>

                        <span class="btn mr-3 my-3 btn2-secondary" id="subBtn">
                            <i class="fas fa-save"></i> Save
                        </span>

                    </div>
                </div>
            </div>
        </div>
    </form>

</div>
@stop


@push('scripts')

    @vite('resources/admin_assets/js/partial/create.js')

@endpush
