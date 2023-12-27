<?php 
require './config/function.php';
$paramResult = checkParamId('id');
if(is_numeric($paramResult)){

    $adminId = validate($paramResult);

    $admin = getById('admins', $adminId);
    if($admin['status'] == 200){
        $adminDeleteRes = delete('admins', $adminId);
        if($adminDeleteRes){
            redirect('admins.php', "Admin deleted successfully.");
        }else{
            redirect('admins.php','something went wrong.');
        }
    }else{
        redirect('admin.php',$admin['message']);
    }
}else{
    redirect('admins.php','something went wrong.');
}

$adminData = delete('admins', $adminId);
?>