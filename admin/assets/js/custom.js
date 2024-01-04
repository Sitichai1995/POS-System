$(document).ready(function () {

    $(document).on('click', '.increment', function () {

        let $quantityInput = $(this).closest('.qty-box').find('.qty');
        let productId = $(this).closest('.qty-box').find('.prodId').val();

        let currentValue = parseInt($quantityInput.val());

        // console.log(currentValue);
        // return false
        if (!isNaN(currentValue)) {
            let qtyVal = currentValue + 1;
            console.log(qtyVal);

            $quantityInput.val(qtyVal);
            quantityIncDec(productId, qtyVal)
        }
    });


    $(document).on('click', '.decrement', function () {

        let $quantityInput = $(this).closest('.qty-box').find('.qty');
        let productId = $(this).closest('.qty-box').find('.prodId').val();

        let currentValue = parseInt($quantityInput.val());

        // console.log(currentValue);
        // return false
        if (!isNaN(currentValue) && currentValue > 1) {
            let qtyVal = currentValue - 1;
            console.log(qtyVal);

            $quantityInput.val(qtyVal);
            quantityIncDec(productId, qtyVal);
        }
    });

    function quantityIncDec(prodId, qty) {
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

    //proceed to place order button click
    $(document).on('click', '.proceedToPlace', function () {

        let cPhone = $('#cphone').val();
        let paymentMode = $('#payment_mode').val();
        if (paymentMode == '') {
            swal("select payment Mode", "Please select your payment mode", "warning");
            alert('test');
            return false;
        }

        if (cPhone == '' && !$.isNumeric(cPhone)) {
            swal("Enter phone number", "Please Enter phone number", "warning");
            return false;
        }
        
        let data = {
            'proceedToPlaceBtn': true,
            'cPhone': cPhone,
            'paymentMode': paymentMode
        };

       
        $.ajax({
            type: "POST",
            url: "order-code.php",
            data: data,
            success: function (response) {
                // console.log(response);
                // return false;
                let res = JSON.parse(response);
                // console.log(res);
                // return false;
                if (res.status == 200) {
                    window.location.href = "order-summary.php";

                } else if (res.status == 400) {

                    swal(res.message, res.message, res.status_type, {
                        buttons: {
                            catch: {
                                text: "Add cutomer",
                                value: "catch"
                            },
                            cancel: "Cancel"
                        }
                    })
                        .then((value) => {
                            switch (value) {
                                case "catch":
                                $('#addCustomerModal').modal('show');
                                //console.log('Pop the customer add modal.')
                                break;
                                default:
                            }


                        });

                }else{
                    swal(res.message, res.message, res.status_type);
                }


            }
        });
    });
});