<?php 
    include('includes/header.php'); 
?>
  
    <div class="container-fluid px-4">
        <div class="card mt-4 shadow-md">
            <div class="card-header">
                <h4 class="mb-0">Add Customer
                    <a href="customers.php" class="btn btn-primary float-end">Back</a>
                </h4>

            </div>
        </div>
        <div class="card-body">
            <?php alertMessage();?>
            <form action="code.php" method="POST">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="">Name *</label>
                        <input type="text" name="name" required class="form-control" />
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Email</label>
                        <input type="email" name="email" class="form-control" />
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Phone</label>
                        <input type="tel" name="phone" class="form-control" />
                    </div>
                    <div class="col-md-6">
                        <label for="">Status (checked = Hidden, unchecked = visible)</label>
                        <br/>
                        <input type="checkbox" name="status" style="width: 30px; height: 30px;" class="">
                    </div>
                    <div class="col-md-6 mb-3">
                        <br/>
                        <button type="submit" name="saveCustomer" class="btn btn-success">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

<?php include('includes/footer.php')?>