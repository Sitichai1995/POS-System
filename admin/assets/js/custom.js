$(document).ready(function(){

    $(document).on('click','.increment', function () {
        
        let $quantityInput = $(this).closest('.qty-box').find('.qty');
        let productId = $(this).closest('.qty-box').find('.prodId').val();

        let currentValue = parseInt($quantityInput.val());
        
        // console.log(currentValue);
        // return false
        if (!isNaN(currentValue)) {
            let qtyVal = currentValue + 1 ;
            console.log(qtyVal);
        
            $quantityInput.val(qtyVal);
            quantityIncDec (productId, qtyVal)
        }
    });

    
    $(document).on('click','.decrement', function () {
        
        let $quantityInput = $(this).closest('.qty-box').find('.qty');
        let productId = $(this).closest('.qty-box').find('.prodId').val();

        let currentValue = parseInt($quantityInput.val());

        // console.log(currentValue);
        // return false
        if (!isNaN(currentValue) && currentValue > 1) {
            let qtyVal = currentValue - 1 ;
            console.log(qtyVal);
        
            $quantityInput.val(qtyVal);
            quantityIncDec (productId, qtyVal);
        }
    });

    function quantityIncDec (prodId, qty){
        $.ajax({
            type: "POST",
            url: "order-code.php",
            data: {
                'productIncDec': true,
                'product_id': prodId,
                'quantity': qty,

            },
            success: function (response) {
                let res = JSON.parse(response);
                
                if (res.status == 200) {
                    window.location.reload();
                    alertify().success(res.message);

                } else {
                    alertify().error(res.message);
                }
            }
        });
    }
});