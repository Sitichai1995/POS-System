<?php

require('./config/function.php');
// echo'test';
// exit();

if (!isset($_SESSION['productItems'])) {
    $_SESSION['productItems'] = [];
}

if (!isset($_SESSION['productItemIds'])) {
    $_SESSION['productItemIds'] = [];
}

if (isset($_POST['addItem'])) {
    // echo 'test111';
    // exit();
    $productId = validate($_POST['productId']);
    $quantity = validate($_POST['quantity']);

    
    $checkProduct = mysqli_query($conn, "SELECT * FROM products WHERE id = '$productId' limit 1 ");

    if ($checkProduct) {
        if (mysqli_num_rows($checkProduct) > 0) {

            $row = mysqli_fetch_assoc($checkProduct);
            if ($row['quantity'] < $quantity) {
                redirect('order-create.php', 'Only' .$row['quantity']. 'quantity avaliable!');
            }

            $productData = [
                'production_id' => $row['id'],
                'name' => $row['name'],
                'image' => $row['image'],
                'price' => $row['price'],
                'quantity' => $quantity
            ];

            if (!in_array($row['id'], $_SESSION['productItemIds'])) {
                
                array_push($_SESSION['productItemIds'],$row['id']);
                array_push($_SESSION['productItems'],$productData);
            }else{
                foreach ($_SESSION['productItems'] as $key => $productSessionItem) {
                    if ($productSessionItem['product_id'] == $row['id']) {
                        
                        $newQuantity = $productSessionItem['quantity']+ $quantity;

                        $productData = [
                            'production_id' => $row['id'],
                            'name' => $row['name'],
                            'image' => $row['image'],
                            'price' => $row['price'],
                            'quantity' => $quantity
                        ];

                        $_SESSION['productItems'][$key] = $productData;
                    }
                }
            }
            redirect('order-create.php', 'Item Added ' .$row['name']);

            
        }else{
            redirect('order-create.php', 'No such product found.');
        }
    } else {
        redirect('order-create.php', 'Something went wrong.');
    }
}

if (isset($_POST['productIncDec'])) {
    $productId = validate($_POST['product_id']);
    $quantity = validate($_POST['quantity']);

    $flag = false;
    foreach ($_SESSION['productItems'] as $key => $item) {
        if ($item['production_id'] == $productId) {
            $flag = true;
            $_SESSION['productItems'][$key]['quantity'] = $quantity;
        }
    }

    if ($flag) {

        jsonResponse (200, 'success', 'Quantity Updated');
    }else{

        jsonResponse (500, 'error', 'something went wrong.');
    }
}


if (isset($_POST['proceedToPlaceBtn'])) {
    $cPhone = validate($_POST['cPhone']);
    //next here
}