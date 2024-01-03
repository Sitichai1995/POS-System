<?php

require "./config/function.php";

$param = checkParamId('index');

if (is_numeric($param)) {
    
    $indexvalue = validate($param);
    if (isset($_SESSION['productItems']) && isset($_SESSION['productItemIds'])) {
        
        unset($_SESSION['productItems'][$indexvalue]);
        unset($_SESSION['productItemIds'][$indexvalue]);

        redirect('order-create.php','Item removed;');

    } else {
        redirect('order-create.php','No item.');
    }
    
}else{
    redirect('order-create.php','param not numeric');
}