<?php 
require './config/function.php';
$paramResult = checkParamId('id');

if(is_numeric($paramResult)){

    $itemId = validate($paramResult);

    $itemData = getById('categories', $itemId);
    if($itemData['status'] == 200){
        // redirect('categories.php',  $itemData);
        // exit();
        $itemDeleteRes = delete('categories', $itemId);
        if($itemDeleteRes){
            redirect('categories.php', "deleted successfully.");
        }else{
            redirect('categories.php','something went wrong.');
        }
    }else{
        redirect('categories.php',$itemData['message']);
    }
}else{
    redirect('categories.php','something went wrong.');
}

$adminData = delete('admins', $adminId);
?>