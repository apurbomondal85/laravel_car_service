$(document).ready(function () {
    var i = 1;
    $("#add").click(function () {
        i++;
        $('#dynamic_field').append('<div class="row mt-2" id="row' + i + '">' +
            '<div class="col-xl-4 col-sm-4 col-12">' +
            '<input type="text" name="file_name[]" placeholder="Enter Name" class="form-control name_list" /> ' +
            '</div>' +

            '<div class="col-xl-5 col-sm-6 col-12">' +
                '<div class="file-upload-section d-flex d-inline-flex">'+
                 '   <input name="images[]" type="file" class="form-control d-none attached_file" allowed="*">'+
                 '       <div class="input-group">'+
                 '           <input type="text" class="form-control file-upload-info" disabled="" readonly'+
                 '               placeholder="Size: 200x200 and max 500kB">'+
                 '           <span>'+
                 '               <button class="file-upload-browse btn btn-outline-secondary pb-3"'+
                 '                   type="button"><i class="fas fa-upload"></i> Browse</button>'+
                 '           </span>'+
                 '       </div>'+
                 '       <div class="display-input-image display-input-image2 d-none">'+
                 '           <img src="" width="120" alt="Preview Image" />'+
                 '<button type="button" class="img-x btn btn-sm btn-outline-danger file-upload-remove" title="Remove">x</button>' +
                 '       </div>'+
                 '   </div>'+
                '</div>' +

            '    <div class="col-md-2 ml-5">' +
            '        <button type="button" name="remove" id="' + i + '" class="btn btn-danger btn-sm icon-btn ms-3 mt-2 btn_remove"><i class="fas fa-close"></i></button>' +
            '    </div>' +
            '</div>');
    });

    $(document).on('click', '.btn_remove', function () {
        var button_id = $(this).attr("id");
        $('#row' + button_id + '').remove();
    });
});


$(document).on('click', '#subBtn', function () {
    let nameRequired = false;
    let fileRequired = false;

    var arrName = $('.name_list').map((i, e) => e.value).get();
    var arrFile = $('.attached_file').map((i, e) => e.value).get();

    arrName.forEach(element => {
        if (element == '') {
            nameRequired = true;
        }
    });

    arrFile.forEach(element => {
        if (element == '') {
            fileRequired = true
        }
    });

    if(arrName.length<=1){
        if(arrName[0]=='' && arrFile[0]==''){
            nameRequired=false;
            fileRequired=false;
        }
    }

    if (nameRequired) {
        $("#nameError").text('All Name field is required');
    } else {
        $("#nameError").text('');
    }

    if (fileRequired) {
        $("#fileError").text('All Attachment field is required');
    } else {
        $("#fileError").text('');
    }

    if (!nameRequired && !fileRequired) {
        $('#subBtnFinal').click();
    }

    return;
});
