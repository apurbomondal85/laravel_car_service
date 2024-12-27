$(document).ready(function () {
    $(document).on('keyup change','#quantity',function(){
        var quantity = parseFloat($('#quantity').val());
        var stock = parseFloat($('#stock').val());

        if(quantity > stock){
            $('#quantity').val('');

            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'You can not Give more than your current stock !!!',
            });
        }
    });
});

$(document).ready(function () {
    $(document).on('keyup change','#quantity, #price',function(){
        var quantity = parseFloat($('#quantity').val());
        var price = parseFloat($('#price').val());
        var total = parseFloat(quantity * price).toFixed(2);

        $('#total').val(total);
    });
});
