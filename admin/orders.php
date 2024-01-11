<?php
include('includes/header.php');
?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-md">
        <div class="card-header">
            <h4 class="mb-0">Orders
            </h4>
            <div class="card-body">

                <?php
                $query = "SELECT o.* , c.* FROM orders o, customers c WHERE c.id = o.customer_id ORDER BY o.id DESC";
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
                                    <td class="fw-bold"><?= $item['tracking_no']?></td>
                                    <td><?= $item['name']?></td>
                                    <td><?= $item['phone']?></td>
                                    <td><?= date('d M, Y',strtotime($item['order_date']));?></td>
                                    <td><?= $item['order_status']?></td>
                                    <td><?= $item['payment_mode']?></td>
                                    <td>
                                        <a class="btn btn-info mb-0 px-2 btn-sm" href="order-view.php?track=<?= $item['tracking_no']?>">View</a>
                                        <a class="btn btn-primary mb-0 px-2 btn-sm">Print</a>
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

</div>

<?php include('includes/footer.php') ?>