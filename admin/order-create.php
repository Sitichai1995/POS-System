<?php
include('includes/header.php');
?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-md">
        <div class="card-header">
            <h4 class="mb-0">Add Order
                <a href="orders.php" class="btn btn-primary float-end">Back</a>
            </h4>

        </div>
    </div>
    <div class="card-body">
        <?php alertMessage(); ?>
        <form action="order-code.php" method="POST">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="">Select production</label>
                    <select name="productId" class="form-select mySelect2">
                        <option value=""> -- Select Product --</option>
                        <?php
                        $products = getAll('products');
                        if ($products) {
                            if (mysqli_num_rows($products) > 0) {
                                foreach ($products as $item) {
                                    ?>
                                        <option value="<?= $item['id']; ?>"><?= $item['name']; ?></option>
                                    <?php
                                }
                            }else{
                                echo '<h5> No product found. </h5>';
                            }
                        } else {
                            echo '<h5> Something went wrong. </h5>';
                        }

                        ?>
                    </select>

                </div>
                <div class="col-md-2 mb-3">
                    <label for="">Quantity</label>
                    <input type="number" name="quantity" value="1" class="form-control" />
                </div>
                
                <div class="col-md-6 mb-3">
                    <br />
                    <button type="submit" name="addItem" class="btn btn-success">Add item</button>
                </div>
            </div>
        </form>
    </div>
    <?php
        print_r($_SESSION['productItemIds']);
        ?>
        <br/>
        <?php
        print_r($_SESSION['productItems']);
    ?>
</div>

<?php include('includes/footer.php') ?>