<div class="row" id="refForm">
    <label class="col-xl-2 col-sm-12 col-12 col-form-label">{{ __('Attachment') }} {{ old('images.0') }}</label>
    <div class="col-xl-10 col-sm-12 col-12" id="dynamic_field">
        <div class="row">
            <div class="col-xl-4 col-sm-4 col-12">
                <input type="text" name="file_name[]" placeholder="Enter Name"
                    class="form-control name_list"/>
            </div>

            <div class="col-xl-5 col-sm-6 col-12">
                <div class="file-upload-section d-flex d-inline-flex">
                    <input name="images[]" type="file" class="form-control d-none attached_file"
                        allowed="*" >
                    <div class="input-group">
                        <input type="text" class="form-control file-upload-info" disabled="" readonly
                            placeholder="Size: 200x200 and max 500kB">
                        <span>
                            <button class="file-upload-browse btn btn-outline-secondary pb-3"
                                type="button"><i class="fas fa-upload"></i> Browse</button>
                        </span>
                    </div>

                    <div class="display-input-image display-input-image2 d-none">
                        <img width="120" src="" alt="Preview Image" />

                        <button type="button"
                            class="img-x btn btn-sm btn-outline-danger file-upload-remove"
                            title="Remove">x</button>
                    </div>
                </div>
            </div>

            <div class="col-md-2 mt-2 ml-5">
                <button type="button" class="btn btn-info btn-sm icon-btn ms-3" id="add">
                    <i class="ti-plus"></i>
                </button>
            </div>

        </div>
    </div>

    <div class="col-xl-2"></div>
    <div class="col-xl-10">
        <div class="row">
            <div class="col-xl-4 col-sm-4 col-12 pt-2 pb-2">
                <p class="text-danger" id="nameError"></p>
            </div>
            <div class="col-xl-8 col-sm-8 col-12 pt-2 pb-2">
                <p class="text-danger" id="fileError"></p>
            </div>
        </div>
    </div>
</div>
