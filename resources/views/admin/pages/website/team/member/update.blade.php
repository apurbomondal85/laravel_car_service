@extends('admin.layouts.master')

@section('title', __('Update Team Member'))

@section('content')
<div class="content-wrapper">

    <div class="content-header d-flex justify-content-start">
        <div class="d-block">
            <h4 class="content-title">{{ strtoupper(__('Update Team Member')) }}</h4>
        </div>
        {!! \App\Library\Html::linkBack(route('admin.team.show', $member->team->id)) !!}
    </div>

    <div class="card shadow-sm col-md-8">
        <div class="card-body py-sm-4">
            <form method="post" action="{{ route('admin.team.member.update', $member->id) }}"
                enctype="multipart/form-data">
                @csrf
                <div class="form-group row @error('team_designation') error @enderror">

                    <label class="col-sm-3 col-form-label required">{{ __('Member Designation') }}</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="team_designation" required>
                            <option value="" class="selected highlighted">Select One</option>
                            @foreach($team_designations as $value)
                            <option value="{{ $value }}" {{(old("team_designation", $member->team_designation) == $value) ? "selected" : ""}}>
                                {{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('team_designation')
                    <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group row @error('member_note') error @enderror">
                    <label class="col-sm-3 col-form-label" for="description">{{ __('About Member') }}</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" name="member_note"
                            rows="6">{{ old('member_note', $member->member_note) }}</textarea>
                        @error('member_note')
                        <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="d-flex justify-content-center col-md-12">
                        {!! \App\Library\Html::btnSubmit() !!}
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@include('admin.assets.summernote-text-editor')

@push('scripts')
<script>
    $('#summernote').summernote({
        height: 400
    });
</script>
@endpush
