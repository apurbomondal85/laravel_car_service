@extends('admin.layouts.master')

@section('title', __('New Club Member'))

@section('content')
<div class="content-wrapper">

    <div class="content-header d-flex justify-content-start">
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper(__('New Club Member')) }}</h4>
        </div>
        {!! \App\Library\Html::linkBack(route('admin.club.show', $club->id)) !!}
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="p-sm-3">
                    <form action="{{ route('admin.club.member.create',$club->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body py-sm-4">

                            <div class="form-group row @error('user_id') error @enderror">
                                <label class="col-sm-3 col-form-label required" for="name">{{ __('Member') }}</label>
                                <div class="col-sm-9">
                                    <select class="select form-control" name="user_id" id="user_id"
                                        style="width: 100%;">
                                        <option selected disabled value="">Select One</option>
                                        @foreach($genaral_members as $genaral_member)
                                        <option value="{{ $genaral_member->id }}"
                                            {{ old('user_id') == $genaral_member->id ? 'selected' : '' }}>
                                            {{ $genaral_member->getFullNameAttribute() }} </option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                    <p class="error-message">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row @error('user_type') error @enderror">
                                <label class="col-sm-3 col-form-label required"
                                    for="name">{{ __('User Type') }}</label>
                                <div class="col-sm-9">
                                    <select class="select form-control" name="user_type" id="user_type"
                                        style="width: 100%;">
                                        <option selected disabled value="">Select One</option>
                                        @foreach($club_member_types as $key => $club_member_type)
                                        <option value="{{ $key }}"
                                            {{ old('user_type') == $key ? 'selected' : '' }}>
                                            {{$club_member_type}} </option>
                                        @endforeach
                                    </select>
                                    @error('user_type')
                                    <p class="error-message">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row @error('designation') error @enderror d-none" id="designation_div">
                                <label class="col-sm-3 col-form-label required"
                                    for="name">{{ __('Designation') }}</label>
                                <div class="col-sm-9">
                                    <select class="select form-control" name="designation" id="designation"
                                        style="width: 100%;">
                                        <option selected disabled value="">Select One</option>
                                        @foreach($club_designations as $key =>$club_designation)
                                        <option value="{{ $key }}"
                                            {{ old('designation') == $key ? 'selected' : '' }}>
                                            {{$club_designation}} </option>
                                        @endforeach
                                    </select>
                                    @error('designation')
                                    <p class="error-message">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row @error('note') error @enderror">
                            <label class="col-sm-3 col-form-label required">{{ __('Note') }}</label>
                            <div class="col-sm-9">
                                <textarea name="note" placeholder="Not about Club" id="message"
                                    class="form-control" rows="8"> {{ old('note') }}</textarea>
                                @error('note')
                                <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        </div>

                        <div class="row">
                            <div class="modal-footer justify-content-center col-md-12">
                                {!! \App\Library\Html::btnReset() !!}
                                {!! \App\Library\Html::btnSubmit() !!}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
@include('admin.assets.dt')
@push('scripts')
<script>
    $(function(){
        $("#user_type").on('change', function(){
          var committee = '{{ \App\Library\Enum::CLUB_MEMBER_TYPE_COMMITTEE }}';
          if(this.value == committee)
          {
            $('#designation_div').removeClass('d-none');
          }else{
            console.log("hello");
            $('#designation_div').addClass('d-none');
            $("#designation").val($("#designation option:first").val());
          }
        })
    });
</script>
@endpush