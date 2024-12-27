$(document).ready(function() {
    $('.select2-multiple').select2({
        placeholder: "Select One",
        allowClear: true
    });

    $(document).on('change', '#subscriber_id', function () {
        if(this.value == 'all'){
            $('#subscriber_id option').prop('selected', true);
            $('#subscriber_id option[value="all"]').prop('selected', false).trigger('change');
        }
    }).change();

    $('#summernote').summernote({
        height: 400
    });
});
