<?php 
require './config/function.php';
$paramResult = checkParamId('id');

if( is_numeric($paramResult)){

    $itemId = validate($paramResult);

    $itemdata = getById('products', $itemId);
    
    if ($itemdata['status'] == 200) {
        
        $deleted = delete('products', $itemId);

        if ($deleted) {
            redirect('products.php','deleted successfully.');
        } else {
            redirect('products.php','something went wrong.');
        }
        

    } else {
        redirect('products.php',$itemData['message']);
    }
    
}
else{
    redirect('products.php','something went wrong.');
}