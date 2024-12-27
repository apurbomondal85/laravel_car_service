<!-- Modal -->
<div class="modal fade" id="changeStatusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-l" role="document">
        <form method="post" action="{{ route('admin.asset.change_status.api',$asset->id) }}" enctype="multipart/form-data" id="updateStatusForm">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> {{ __('Change Status') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row @error('status') error @enderror">
                        <div class="col-sm-12">
                            <select class="form-control" name="status" required>
                                <option value="" class="selected highlighted">Select One</option>
                                @foreach(\App\Library\Enum::getAssetStatus() as $index => $value)

                                    <option value="{{ $index }}" {{ $asset->status == $index ? "selected disabled" : "" }}>
                                        {{ ucwords($value) }}
                                    </option>

                                @endforeach
                            </select>
                            @error('status')
                            <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row @error('quantity') error @enderror">
                        <div class="col-sm-12">
                            <input type="number" class="form-control" name="quantity" id="quantity"
                                value="{{ old('quantity') }}" placeholder="{{ __('Quantity') }}"
                                max="{{ $asset->stock }}" required>
                            @error('quantity')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                </div>

                <div class="modal-footer justify-content-center">
                    {!! \App\Library\Html::btnSubmit() !!}
                </div>
            </div>
        </form>

    </div>
</div>

