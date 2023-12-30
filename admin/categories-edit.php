<?php
include('includes/header.php');
?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-md">
        <div class="card-header">
            <h4 class="mb-0">Edit Category
                <a href="categories.php" class="btn btn-danger float-end">Back</a>
            </h4>

        </div>
    </div>
    <div class="card-body">
        <?php alertMessage(); ?>
        <form action="code.php" method="POST">

            <?php
                if (isset($_GET['id'])) {
                    if ($_GET['id'] != '') {

                        $itemId = $_GET['id'];
                    } else {
                        echo ' <h5> No Id found </h5>';
                        return false;
                    }
                } else {
                    echo '<h5> No Id given in params </h5>';
                    return false;
                }

                $itemData = getById('categories', $itemId);
                if ($itemData) {

                    if ($itemData['status'] == 200) {

            ?>
            <input type="hidden" name="itemId" value="<?= $itemData['data']['id'] ?>">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="">Name *</label>
                    <input type="text" name="name" required value="<?= $itemData['data']['name'] ?>" class="form-control" />
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Description</label>
                    <textarea name="description" rows="3" value="" class="form-control"><?= $itemData['data']['description'] ?></textarea>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="">Status</label>
                    <input type="checkbox" name="status" value="<?= $itemData['data']['status'] == true ? 'checked' : ''; ?>" style="width:30px; height:30px;" />
                </div>
                <div class="col-md-3 mb-3">
                    <button type="submit" name="UpdateCategory" class="btn btn-success">Update</button>
                </div>
            </div>
            <?php
                } else {
                    echo '<h5>' . $itemData['message'] . ' </h5>';
                }
            } else {
                echo ' <h5> something went wrong. </h5>';
                return false;
            }
            ?>


        </form>
    </div>
</div>

<?php include('includes/footer.php') ?>