$(document).ready(function () {
    $('#summernote').summernote({
        height: 285
    });

    $("#category").select2({
        placeholder: "Select One",
        allowClear: true
    });
});
