$(document).ready(function () {
    $(document).on('keyup change','#quantity, #price',function(){
        var quantity = parseFloat($('#quantity').val());
        var price = parseFloat($('#price').val());
        var total = parseFloat(quantity * price).toFixed(2);

        $('#total').val(total);
    });
});
