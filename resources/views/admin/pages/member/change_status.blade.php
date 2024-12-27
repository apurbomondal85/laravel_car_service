<!-- Modal -->
<div class="modal fade" id="changeStatusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <form method="post" action="{{ route('admin.user.change_status.api',$user->id) }}" enctype="multipart/form-data" id="updateStatusForm">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> {{ __('Change Status') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-0 @error('status') error @enderror">
                        <select class="form-control" name="status" required>
                            <option value="" class="selected highlighted" disabled>Select One</option>
                            @foreach(\App\Library\Enum::getUserStatus() as $index => $value)
                                <option value="{{ $index }}" {{ $user->status == $index ? "selected" : ""}} >{{ ucwords($value) }}</option>
                            @endforeach
                        </select>
                        @error('status')
                        <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer justify-content-center">
                    {!! \App\Library\Html::btnSubmit() !!}
                </div>
            </div>
        </form>

    </div>
</div>
