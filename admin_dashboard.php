<?php include 'header.php'?>
<marquee><h2 style="margin-top: 100px;">Welcome <?php echo $_SESSION['admin'];?>	</h2></marquee>
<div class="container" style="margin:0 auto;padding-top:30px;padding-bottom:30px;">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    
                    <li class="nav-item">
                        <a href="add_event.php" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i><span>  Add Events</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="add_package.php" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i><span>  Add Package</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="add_pricing.php" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i><span>  Add Pricing</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="confirmation.php" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i><span>  Confirmation</span>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="logout.php" class="nav-link">
                        <i class="nav-icon fas fa-inbox"></i>  logout
                        
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
<?php include 'footer.php';?>