<div class="card shadow-sm">
    <div class="card-body">
        <h4 class="card-title">New Team</h4>
        <hr>
        <form method="post" action="{{ route('admin.team.create') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group @error('name') error @enderror">
                <label class="required">{{ __('Name') }}</label>

                <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                    placeholder="{{ __('Write Your Team Name') }}" required>
                @error('name')
                <p class="error-message">{{ $message }}</p>
                @enderror

            </div>
            <div class="form-group @error('short_description') error @enderror">
                <label >{{ __('Short Description') }}</label>
                <textarea type="text" class="form-control" name="short_description"
                    value="{{ old('short_description') }}" placeholder="{{ __('Write About Team') }}"
                    rows="6"></textarea>
                @error('short_description')
                <p class="error-message">{{ $message }}</p>
                @enderror

            </div>

            <div class="row">
                <div class="d-flex justify-content-center col-md-12">
                    {!! \App\Library\Html::btnReset() !!}
                    {!! \App\Library\Html::btnSubmit() !!}
                </div>
            </div>
        </form>
    </div>
</div>