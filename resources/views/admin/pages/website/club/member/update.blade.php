@extends('admin.layouts.master')

@section('title', __('Update Member'))

@section('content')

    <div class="content-wrapper">

        <div class="content-header d-flex justify-content-start">
            <div class="d-block">
                <h4 class="content-title">{{ strtoupper(__('Update Member')) }}</h4>
            </div>
            {!! \App\Library\Html::linkBack(route('admin.club.show', $club->id)) !!}
        </div>

        <div class="card mb-4 shadow-sm col-md-6">
            <div class="card-body py-sm-4">

                <div class="text-center">
                    <img src="{{ $club->getFeaturedImage() }}" alt="profile" class="img-lg rounded-circle mb-3">
                    <div class="mb-3 border-bottom py-3">
                        <h3>{{ $club->name }}</h3>
                        <div class="d-flex align-items-center justify-content-center">
                            <h5 class="mb-0 me-2 text-muted">
                                <span class="badge {{ $club->is_active ? "btn2-secondary" : "btn-secondary" }}">
                                    {{ $club->is_active ? "Active" : "Inactive" }}
                                </span>
                            </h5>
                        </div>
                        <p class="w-75 mx-auto mb-3 pt-3">{{ $club->description }}</p>
                    </div>
                </div>

                <div class="pt-4">
                    <form action="{{ route('admin.club.member.update', [$club->id, $clubCommittee->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="club_id" value="{{ $club->id }}">

                        <div class="col-md-12">
                            <div class="form-group row @error('user_id') error @enderror">
                                <label class="col-sm-3 col-form-label required">{{ __('Member') }}</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="user_id" required>
                                        <option value="" class="selected highlighted">Select One</option>
                                        @foreach($member as $row)
                                            <option value="{{ $row->id }}" {{(old("user_id", $clubCommittee->user_id) == $row->id) ? "selected" : ""}}>
                                                {{ $row->nick_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <p class="error-message">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row @error('user_type') error @enderror">
                                <label class="col-sm-3 col-form-label required">{{ __('Member Type') }}</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="user_type" required>
                                        <option value="" class="selected highlighted">Select One</option>
                                        
                                        <option value="member" {{(old("user_type", $clubCommittee->user_type) == 'member') ? "selected" : ""}}>Member</option>
                                        <option value="committee" {{(old("user_type", $clubCommittee->user_type) == 'committee') ? "selected" : ""}}>Committee</option>
                                        
                                    </select>
                                    @error('user_type')
                                        <p class="error-message">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row @error('designation') error @enderror">
                                <label class="col-sm-3 col-form-label required">{{ __('Designation') }}</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="designation" required>
                                        <option value="" class="selected highlighted">Select One</option>
                                        @foreach($designation as $value)
                                            <option value="{{ $value }}" {{(old("designation", $clubCommittee->designation) == $value) ? "selected" : ""}}>
                                                {{ ucwords($value) }}</option>
                                        @endforeach
                                    </select>
                                    @error('designation')
                                        <p class="error-message">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row @error('note') error @enderror">
                                <label class="col-sm-3 col-form-label" for="note">{{ __('Notes') }}</label>
                                <div class="col-sm-9">
                                    <textarea type="text" name="note" class="form-control"
                                        placeholder="{{ __('Write Short Notes') }}" rows="4">{{ old('note', $clubCommittee->note) }}</textarea>
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
@stop

@push('scripts')
    <script type="application/javascript">

    </script>
@endpush
