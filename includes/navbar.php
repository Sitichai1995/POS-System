<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">

    <div class="navbar-brand ps-3" href="../index.php">POS system</div>        
        <div class="p-2 me-auto">
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <?php if(isset($_SESSION['loggedIn'])) : ?>
                            <li><a class="dropdown-item fs-5" href="#!"><?= $_SESSION['loggedInUser']['name']?></a></li>
                            <li><hr class="dropdown-divider" /></li>
                            <li><a class="dropdown-item" href="#!">Settings</a></li>
                            <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                            <li><hr class="dropdown-divider" /></li>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        <?php else: ?>
                            <li><a class="dropdown-item" href="../login.php">login</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
            </ul>
        </div>
</nav>
