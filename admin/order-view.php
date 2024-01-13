<?php
include('includes/header.php');
?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-md">
        <div class="card-header">
            <h4 class="mb-0">Orders</h4>
            <a href="orders-view-print.php?track=<?= $_GET['track'] ?>" class="btn btn-info mx-2 btn-sm float-end">Print</a>
            <a href="orders.php" class="btn btn-secondary mx-2 btn-sm float-end">ฺBack</a>
            <div class="card-body">

                <?php alertMessage() ?>

                <?php
                if (isset($_GET['track'])) {
                    $trackingNo = validate($_GET['track']);

                    ?>
                    <p><?= $trackingNo?></p>
                    <?php
                    $query = "SELECT customers.* , orders.* FROM orders, customers WHERE customers.id = orders.customer_id AND tracking_no = '$trackingNo' ORDER BY orders.id DESC";

                    $orders = mysqli_query($conn, $query);

                    if ($orders) {
                        if (mysqli_num_rows($orders) > 0) {
                            $orderData = mysqli_fetch_assoc($orders);
                            

                            $orderId = $orderData['id'];
                            ?>
                            <div class="card card-body shadow border-1mb-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4>Order Details</h4>
                                        <label class="mb-1">Tracking No.
                                            <span class="fw-bold"><?= $orderData['tracking_no'] ?> </span>
                                        </label>
                                        <br />
                                        <label class="mb-1">Orders date:
                                            <span class="fw-bold"><?= $orderData['order_date'] ?> </span>
                                        </label>
                                        <br />
                                        <label class="mb-1">Orders Status::
                                            <span class="fw-bold"><?= $orderData['order_status'] ?> </span>
                                        </label>
                                        <br />
                                        <label class="mb-1">Payment mode :
                                            <span class="fw-bold"><?= $orderData['payment_mode'] ?> </span>
                                        </label>
                                        <br />
                                    </div>
                                    <div class="col-md-6">
                                        <h4>User Details</h4>
                                        <label class="mb-1">
                                            Full Name:
                                            <span class="fw-bold"><?= $orderData['name']; ?></span>
                                        </label>
                                        <br/>
                                        <label class="mb-1">
                                            Email Address:
                                            <span class="fw-bold"><?= $orderData['email']; ?></span>
                                        </label>
                                        <br/>
                                        <label class="mb-1">
                                            Phone Number:
                                            <span class="fw-bold"><?= $orderData['phone']; ?></span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <?php
                                $orderItemQuery = "SELECT order_items.quantity AS orderItemQuantity, order_items.price AS orderItemPrice, orders.*, order_items.*, products.* FROM orders ,order_items, products WHERE order_items.order_id = orders.id AND products.id = order_items.product_id AND orders.tracking_no = '$trackingNo'";
                                
                                $orderItemsRes = mysqli_query($conn, $orderItemQuery);
                                if ($orderItemsRes) {
                                    if (mysqli_num_rows($orderItemsRes) > 0) {

                                        ?>
                                            <h4 class="my-3"> Order Items Details</h4>
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th class="">Products</th>
                                                        <th>Price</th>
                                                        <th>Quantity</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                    foreach ($orderItemsRes as $orderItemRow) : 
                                                    ?>
                                                    <tr>
                                                        <td class="text-center fw-bold">
                                                            <?= $orderItemRow['name']?>
                                                        </td>
                                                        <td width='15%' class="fw-bold text-center">
                                                            <?= number_format($orderItemRow['orderItemPrice'])?>
                                                        </td>
                                                        <td width='15%' class="fw-bold text-center">
                                                            <?= $orderItemRow['orderItemQuantity']?>
                                                        </td>
                                                        <td width='15%' class="fw-bold text-center">
                                                            <?= number_format($orderItemRow['orderItemPrice'] * $orderItemRow['orderItemQuantity'])?>
                                                        </td>
                                                    </tr>

                                                    <?php endforeach; ?>

                                                    <tr>
                                                        <td class="text-end fw-bold">Total Price:</td>
                                                        <td colspan="3" class="text-center fw-bold"><?= number_format($orderItemRow['total_amount'],0)?> $</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        <?php
                                        
                                    } else {
                                        echo "<h5> Something went wrong about order detail. </h5>";
                                    return false;
                                    }
                                    

                                    
                                } else {
                                    echo "<h5> Something went wrong. </h5>";
                                    return false;
                                }
                                
                            ?>
                            <?php
                        } else {
                            echo "<h5> No Record found. </h5>";
                            return false;
                        }
                    } else {
                        echo "<h5> Something went wrong. </h5>";
                    }
                }
                ?>

            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php') ?>
