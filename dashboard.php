<?php include 'header.php';?>
    <marquee><h2 style="margin-top: 100px;">Welcome <?php echo $_SESSION['user_name'];?>	</h2></marquee>
    
    <div class="container" style="margin:0 auto;padding-top:30px;padding-bottom:30px;">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="booking_details.php?u_id=<?php echo $_SESSION['user_id']; ?>" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i><span> Booking Details</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="book_events.php?u_id=<?php echo $_SESSION['user_id']; ?>" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i><span> Book Events</span>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="logout.php" class="nav-link">
                            <i class="nav-icon fas fa-inbox"></i> logout
                            
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
<?php include 'footer.php';?>
