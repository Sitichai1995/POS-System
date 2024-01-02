<?php
require './config/function.php';

$paramId = checkParamId('id');

if (is_numeric($paramId)) {

    $validateCustomerId = validate($paramId);

    $customerData = getById('customers', $validateCustomerId);

    if ($customerData['status'] == 200) {

        $customerDeleteRes = delete('customers', $validateCustomerId);

        if ($customerDeleteRes) {
            redirect('customers.php', "customers deleted successfully.");
        } else {
            redirect('customers.php', 'something went wrong.');
        }
    } else {
        redirect('customers.php', $customerData['message']);
    }
} else {
    redirect('customers.php', 'something went wrong.');
}
