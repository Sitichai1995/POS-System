<?php
include('includes/header.php');
?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-md">
        <div class="card-header">
            <h4 class="mb-0">Print Order
                <a href="orders.php" class="btn btn-secondary float-end">Back</a>
            </h4>

        </div>
        <div class="card-body">
            <?php
            if (isset($_GET['track'])) {
                $trackingNo = validate($_GET['track']);
                if ($trackingNo == '') {
            ?>
                    <div class="text-center py-5">
                        <h5>Please provide tracking number</h5>
                        <div class="">
                            <a href="orders.php" class="btn btn-secondary mt-4 w-25">Go back to orders.</a>
                        </div>
                    </div>
                <?php
                }

                $orderQuery = "SELECT orders.*, customers.* FROM orders, customers WHERE customers.id = orders.id AND tracking_no='$trackingNo' LIMIT 1";
                $orderQueryRes = mysqli_query($conn, $orderQuery);
                if (!$orderQueryRes) {
                    echo "<h5> Something went wrong.</h5>";
                    return false;
                }

                if (mysqli_num_rows($orderQueryRes) > 0) {

                    $rowData = mysqli_fetch_assoc($orderQueryRes);
                    // print_r($rowData);
                ?>

                    <table style="width: 100%; margin-bottom: 20px;">
                        <tr>
                            <td style="text-align: center;">
                                <h4 style="font-size: 23px; line-height: 30px; margin: 2px; padding: 0;">Customer Details</h4>
                                <p style="font-size: 16px; line-height: 24px; margin: 2px; padding: 0;">23 street</p>
                                <p style="font-size: 16px; line-height: 24px; margin: 2px; padding: 0;">company xyz</p>
                            </td>

                            <td>
                                <h5 style="font-size: 20px; line-height: 30px; margin: 0px; padding: 0;">Customer Details</h5>
                                <p style="font-size: 14px; line-height: 20px; margin: 0px; padding: 0;">Customer Name: <?= $rowData['name'] ?></p>
                                <p style="font-size: 14px; line-height: 20px; margin: 0px; padding: 0;">Customer Phone NO. <?= $rowData['phone'] ?></p>
                                <p style="font-size: 14px; line-height: 20px; margin: 0px; padding: 0;">Customer Email ID:<?= $rowData['email'] ?></p>
                            </td>

                            <td align="end">
                                <h5 style="font-size: 20px; line-height: 30px; margin: 0px; padding: 0;">Invoice Details</h5>
                                <p style="font-size: 14px; line-height: 20px; margin: 0px; padding: 0;">Invoice No: <?= $rowData['tracking_no']; ?></p>
                                <p style="font-size: 14px; line-height: 20px; margin: 0px; padding: 0;">Customer Date <?= date('d M Y') ?></p>
                                <p style="font-size: 14px; line-height: 20px; margin: 0px; padding: 0;">Address: 1st </p>
                            </td>
                        </tr>
                    </table>


                <?php
                } else {
                    echo "<h5> No Customer found.</h5>";
                    return false;
                }

                $orderItemQuery = "SELECT order_items.quantity AS orderItemQuantity, order_items.price AS orderItemPrice, orders.*, order_items.*, products.* FROM orders, order_items, products WHERE order_items.order_id = orders.id AND products.id = order_items.product_id AND orders.tracking_no = '$trackingNo'";

                $orderItemsQueryRes = mysqli_query($conn, $orderItemQuery);

                if ($orderItemsQueryRes) {
                    if (mysqli_num_rows($orderItemsQueryRes) > 0) {
                        ?>
                        <div class="table-responsive mb-3">
                                <table style="width:100%" cellpadding="5">
                                    <thead>
                                        <tr>
                                            <th align="start" style="border-bottom: 1px solid #ccc;" width="5%">ID</th>
                                            <th align="start" style="border-bottom: 1px solid #ccc;">Product Name</th>
                                            <th align="start" style="border-bottom: 1px solid #ccc;" width="10%">Price</th>
                                            <th align="start" style="border-bottom: 1px solid #ccc;" width="10%">Quantity</th>
                                            <th align="start" style="border-bottom: 1px solid #ccc;" width="15%">Total Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        
                                        foreach ($orderItemsQueryRes as $key => $row) :
                                            
                                        ?>
                                            <tr>
                                                <td style="border-bottom: 1px solid #ccc;"><?= $i++ ?></td>
                                                <td style="border-bottom: 1px solid #ccc;"><?= $row['name'] ?></td>
                                                <td style="border-bottom: 1px solid #ccc;"><?= number_format($row['orderItemPrice'], 0) ?></td>
                                                <td style="border-bottom: 1px solid #ccc;"><?= $row['orderItemQuantity'] ?></td>
                                                <td style="border-bottom: 1px solid #ccc;" class="fw-bold"><?= number_format($row['orderItemPrice'] * $row['orderItemQuantity'], 0) ?></td>
                                            </tr>
                                        <?php endforeach; ?>

                                        <tr>
                                            <td colspan="4" align="end" style="font-weight: bold;">Grand total:</td>
                                            <td colspan="1" style="font-weight: bold;"><?= number_format($row['total_amount'], 0) ?></td>

                                        </tr>
                                        <tr>
                                            <td colspan="5">Payment Mode: <?= $row['payment_mode']; ?></td>
                                        </tr>
                                    </tbody>

                                </table>

                            </div>

                        <?php

                    } else {
                        echo "<h5> No Customer found.</h5>";
                        return false;
                    }
                }
            } else {
                ?>

                <div class="text-center py-5">
                    <h5>No tracking Number Parameter Found</h5>
                    <div class="">
                        <a href="orders.php" class="btn btn-secondary mt-4 w-25">Go back to orders.</a>
                    </div>
                </div>
            <?php
            }

            ?>

        </div>
    </div>

</div>

<?php include('includes/footer.php') ?>