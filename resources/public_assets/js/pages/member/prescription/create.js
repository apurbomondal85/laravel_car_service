$(document).ready(function () {

    $("#user_id").select2({
        allowClear: true,
        placeholder: "Select User",
    });

    $('#summernote').summernote({
        height: 300,
        placeholder: "Write Description (Required)*",
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']]
        ],
    });

    $("#category").select2({
        placeholder: "Note Type(Required)",
        allowClear: true
    });

    $('input[type=checkbox][name=is_group_session]').change(function () {
        
        if (this.checked) {
            $("#contactPersonDiv").removeClass('d-none');
            $("#multiselectClient").removeClass('d-none');
            $("#number_of_attendance").attr('required', 'required');
        } else {
            $("#contactPersonDiv").addClass('d-none');
            $("#multiselectClient").addClass('d-none');
            $("#number_of_attendance").val('');
            $("#number_of_attendance").removeAttr('required');
        }
    });

});

$(document).ready(function () {
    var i = 1;
    $("#add").click(function () {
        i++;
        $('#dynamic_field').append('<div class="row" id="row' + i + '">' +
            '<div class="col-xl-4 col-sm-4 col-12">' +
            '<div class="form-group row p-1">' +
            '<input type="text" name="name[]" id="name' + i + '" onkeyup="attachmentRequired(' + i + ')" class="form-control"' +
            'placeholder="File Name">' +
            '</div>' +
            '</div>' +

            '<div class="col-xl-6 col-sm-6 col-12">' +
            '<div class="form-group">' +
            '<div class="file-upload-section d-flex d-inline-flex">' +
            '   <input name="attachment[]" type="file" id="attachment' + i + '" onchange="attachmentRequired(' + i + ')" class="form-control d-none" allowed="*">' +
            '       <div class="input-group p-1">' +
            '           <input type="text" class="form-control file-upload-info" disabled="" readonly' +
            '               placeholder="Size: 200x200 and max 500kB">' +
            '           <span>' +
            '               <button class="file-upload-browse btn btn-outline-secondary pb-3"' +
            '                   type="button"><i class="fas fa-upload"></i></button>' +
            '           </span>' +
            '       </div>' +
            '       <div class="display-input-image display-input-image2 d-none">' +
            '           <img src="" alt="Preview Image" />' +
            '       </div>' +
            '   </div>' +
            '</div>' +
            '</div>' +
            '    <div class="col-md-2 d-flex align-items-center">' +
            '<div class="form-group mr-1">' +
            '        <button type="button" name="remove" id="' + i + '" class="btn btn-danger btn-sm icon-btn ms-3 mb-2 btn_remove"><i class="fas fa-close"></i></button>' +
            '    </div>' +
            '    </div>' +
            '</div>');
    });

    $(document).on('click', '.btn_remove', function () {
        var button_id = $(this).attr("id");
        $('#row' + button_id + '').remove();
    });

});

window.attachmentRequired = function (id = '') {
    if (id == 1) {
        if ($('#name1').val() == '' && $('#attachment1').val() == '') {
            $('#name1').attr('required', false);
            $('#attachment1').attr('required', false);
        } else if ($('#name1').val() != '' && $('#attachment1').val() == '') {
            $('#attachment1').attr('required', 'required');
        } else if ($('#attachment1').val() != '' && $('#name1').val() == '') {
            $('#name1').attr('required', 'required');
        }
    } else {
        $('#name' + id + '').attr('required', 'required');
        $('#attachment' + id + '').attr('required', 'required');
    }
}


$(".more").click(function () {
    $(this).text(function (i, v) {
        // if (v === 'More') {
        //     $('#moreDiv').removeClass('d-none');
        //     return 'Close';
        // } else {
        //     $('#moreDiv').addClass('d-none');
        //     return 'More';
        // }
        return v === 'Close' ? 'More' : 'Close';
    });
});

