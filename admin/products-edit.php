<?php
include('includes/header.php');
?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-md">
        <div class="card-header">
            <h4 class="mb-0">Edit Product
                <a href="products.php" class="btn btn-primary float-end">Back</a>
            </h4>

        </div>
    </div>
    <div class="card-body">
        <?php alertMessage(); ?>
        <form action="code.php" method="POST" enctype="multipart/form-data">

            <?php
            $paramValue = checkParamId('id');
            if (!is_numeric($paramValue)) {
                echo '<h5>Id is not an interger </h5>';
                return false;
            }

            $product = getById("products", $paramValue);
            if ($product) {
                if ($product['status'] == 200) {
            ?>
                    <input type="hidden" name="product_id" value="<?= $product['data']['id']; ?>">
                    <div class="row">
                        <div class="col-md-12">
                            <label> Select Category</label>
                            <select name="category_id" class="form-select">
                                <option value="">Select Category</option>
                                <?php
                                $categories = getAll('categories');
                                if ($categories) {

                                    if (mysqli_num_rows($categories) > 0) {
                                        foreach ($categories as $category) {
                                            ?>

                                                <option value="<?=$category['id']; ?>"
                                                <?= $product['data']['category_id'] == $category['id'] ? 'selected': ''; ?>
                                                >
                                                <?= $category['name'] ?>
                                                </option>
                                            <?php
                                        }
                                    } else {
                                        echo '<option value="">No Categories found.</option>';
                                    }
                                } else {
                                    echo '<option value="">Something went wrong.</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="">Product Name *</label>
                            <input type="text" name="name" required value="<?= $product['data']['name'];?>" class="form-control" />
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="">Description</label>
                            <textarea name="description" id="" rows="3" class="form-control"><?= $product['data']['description'];?></textarea>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="">Price</label>
                            <input type="text" name="price" required value="<?= $product['data']['price'];?>" class="form-control" />
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="">Quantity</label>
                            <input type="text" name="quantity" required value="<?= $product['data']['quantity'];?>" class="form-control" />
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="">Image</label>
                            <input type="file" name="image" required class="form-control" />
                            <img  src="../<?= $product['data']['name'];?>" style="width: 40px; height: 40px;" alt="img"/>
                        </div>

                        <div class="col-md-6">
                            <label for="">Status (checked = Hidden, unchecked = visible)</label>
                            <br />
                            
                            <input type="checkbox" name="status" style="width: 30px; height: 30px;" value="<?= $product['data']['name'] == true ? 'checked' : "" ?>" class="">
                        </div>
                        <div class="col-md-6 mb-3">
                            <br />
                            <button type="submit" name="updateProduct" class="btn btn-success">Update</button>
                        </div>
                    </div>
            <?php

                } else {
                    echo '<h5>' . $product['message'] . '</h5>';
                }
            }
            ?>
        </form>
    </div>
</div>

<?php include('includes/footer.php') ?>