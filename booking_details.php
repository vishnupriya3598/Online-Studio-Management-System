<?php include('header.php'); ?>
    <marquee><h2 style="margin-top: 100px;">Welcome <?php echo $_SESSION['user_name'];?>	</h2></marquee>
    <?php
    if(isset($_GET['u_id'])){
       
        $sql="select * from events where u_id=".$_GET['u_id'];
        $result=mysqli_query($con,$sql) or die(mysqli_error());
        $row=mysqli_fetch_array($result);
        if($row){
            
        }else{
            $msg = "No Events Booked";
        }
    }?>
    <div class="container" style="margin:0 auto;padding-top:30px;">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                    <div class="card mb-3">
                        <div class="card-header">
                            <i class="fas fa-table"></i>
                            Booking Details
                        </div><?php
                        if(isset($msg)){?>
                        <div class="alert alert-danger"><?php echo $msg; ?></div><?php
                        }?>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                        <th>S.No</th>
                                        <th>Event Title</th>
                                        <th>Event Date</th>
                                        <th>Event Time</th>
                                        <th>Event Place</th>
                                        <th>IsBooked</th>
                                        <th>Price</th>
                                        <th>Advance Amount</th>
                                        <th>Balance Amount</th>
                                        <th>Cancel Event</th>
                                    </tr>
                                    </thead>
                                    <tbody><?php
                                    $i = 1;
                                    $sql="select * from events where u_id=".$_GET['u_id'];
                                    $result=mysqli_query($con,$sql) or die(mysqli_error());
                                    while($row=mysqli_fetch_array($result)){?>
                                        <tr style="text-align:center;">
                                        <td><?php echo $i;?></td>
                                        <td><?php echo $row['e_title'];?></td>
                                        <td><?php $d=date_create($row['e_date']);
                                        $date = date_format($d,"d/m/Y");
                                        echo $date;
                                        ?></td>
                                        <td><?php echo $row['s_time'];?> to <?php echo $row['e_time'];?></td>
                                        <td><?php echo $row['e_place'];?></td>
                                        <td><?php if($row['IsBooked']=="accepted"){ echo "<span style='color:green;font-weight:bold;'>Accepted</span>"; }elseif($row['IsBooked']=="declined"){ echo "<span style='color:red;font-weight:bold;'>Declined</span>"; }else{ ?><a href="waiting.php?b_id=<?php echo $row['b_id'];?>"><?php echo "<span style='color:orange;font-weight:bold;'>Waiting</span>"; ?></a><?php }?></td>
                                        <td><?php echo $row['price'];?></td>
                                        <td><?php echo $row['advance_amount'];?></td>
                                        <td><?php echo $row['Balance'];?></td>
                                       
                                            <td>
                                            <?php if($row['user_status']=="1"){ echo "<span style='color:red;'>Cancelled</span>";  } else { ?>
                                            <a href="user_cancel.php?id=<?php echo $row['b_id'];?>&u_id=<?php echo $_GET['u_id'];?>" class="btn btn-danger btn-sm">Cancel</a> <?php } ?> </td>
                                        </tr><?php	
                                    $i++; 
                                    } ?>
                                    </tbody>
                                </table>
                            
                            </div>
                            <a href="dashboard.php" class="nav-link">
                                <i class="nav-icon fas fa-inbox"></i> Back
                            </a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
<?php include('footer.php');?>
    