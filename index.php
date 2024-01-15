<?php include('includes/header.php')?>
  
<div class="py-5" style="background-image: url('assets/images/pos-bg.jpg'); background-size: cover; height: 85vh ;">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12" style="margin-top: 100px;">

            <?php alertMessage();?>

                <h1 class="mt-3" style="font-size: 100px;">POS system</h1>

                <?php if (!isset($_SESSION['loggedIn'])): ?>
                <a href="login.php" class="btn btn-primary mt-4">Login</a>

                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
   
<?php include('includes/footer.php')?>
  