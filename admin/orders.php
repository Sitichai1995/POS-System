<?php
include('includes/header.php');
?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-md">
        <div class="card-header">

            <div class="row">
                <div class="col-md-4">
                    <h4 class="mb-0">Orders</h4>
                </div>
                <div class="col-md-8">
                    <form action="" method="get">
                        <div class="row g-1">
                            <div class="col-md-4">
                                <input type="date" name="date" value="<?= isset($_GET['date']) == true ? $_GET['date']: ''; ?>" class="form-control"/>
                            </div>
                            <div class="col-md-4">
                                <!-- <select name="payment_status" class="form-select">
                                    <option value="">Select Payment Status</option>
                                    <option 
                                    value="cash payment" <?= isset($_GET['payment_status']) == true ? ($_GET['payment_status'] == "cash payment" ? 'selected' : '') : "" ;?>
                                    >Cash Payment</option>
                                    <option value="online payment" <?= isset($_GET['payment_status']) == true ? ($_GET['payment_status'] == "online payment" ? 'selected' : '') : "" ;?>>Online Payment</option>
                                </select> -->
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-success">Filter</button>
                                <a href="orders.php" class="btn btn-warning">Reset</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">

            <?php

            if (isset($_GET['date']) || isset($_GET['payment_status'])) {
                
                //validate
                $dateSort = validate($_GET['date']);
                // $paymentSort = validate($_GET['payment_status']);
                $paymentSort ='';

                if ($dateSort != '' && $paymentSort == '') {

                    $query = "SELECT o.* , c.* FROM orders o, customers c WHERE c.id = o.customer_id AND o.order_date= '$dateSort'  ORDER BY o.id DESC";

                }elseif ($dateSort == '' && $paymentSort != '') {
                    
                    $query = "SELECT o.* , c.* FROM orders o, customers c WHERE c.id = o.customer_id AND o.payment_mode= '$paymentSort' ORDER BY o.id DESC";

                }elseif ($dateSort == '' && $paymentSort == '') {
                    $query = "SELECT o.* , c.* FROM orders o, customers c WHERE c.id = o.customer_id AND o.payment_mode= '$paymentSort' AND o.payment_mode= '$paymentSort' ORDER BY o.id DESC";

                }else{

                    $query = "SELECT o.* , c.* FROM orders o, customers c WHERE c.id = o.customer_id ORDER BY o.id DESC";

                }
            } else {
                $query = "SELECT o.* , c.* FROM orders o, customers c WHERE c.id = o.customer_id ORDER BY o.id DESC";
            }
            
            
            $result = mysqli_query($conn, $query);
            if ($result) {

            ?>
                <table class="table table-striped table-bordered align-items-center justify-content-center">
                    <thead>
                        <tr>
                            <th>Tracking No.</th>
                            <th>customer name</th>
                            <th>customer phone</th>
                            <th>Order Date</th>
                            <th>Order status</th>
                            <th>Payment Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($result as $item) : ?>
                            <tr>
                                <td class="fw-bold"><?= $item['tracking_no'] ?></td>
                                <td><?= $item['name'] ?></td>
                                <td><?= $item['phone'] ?></td>
                                <td><?= date('d M, Y', strtotime($item['order_date'])); ?></td>
                                <td><?= $item['order_status'] ?></td>
                                <td><?= $item['payment_mode'] ?></td>
                                <td>
                                    <a class="btn btn-info mb-0 px-2 btn-sm" href="order-view.php?track=<?= $item['tracking_no'] ?>">View</a>
                                    <a href="orders-view-print.php?track=<?= $item['tracking_no'] ?>" class="btn btn-primary mb-0 px-2 btn-sm">Print</a>
                                </td>
                            </tr>

                        <?php endforeach ?>
                    </tbody>

                </table>
            <?php

                if (mysqli_num_rows($result) > 0) {
                } else {
                    echo "<h5> No record avaliable </h5>";
                }
            } else {
                echo "<h5> Something went wrong. </h5>";
            }
            ?>
        </div>
    </div>

</div>

<?php include('includes/footer.php') ?>