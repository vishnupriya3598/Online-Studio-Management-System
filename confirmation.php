<?php include('header.php');?>
    <marquee><h2 style="margin-top: 100px;">Welcome <?php echo $_SESSION['admin'];?>	</h2></marquee><?php
        $msg="";
        if(isset($_SESSION['admin_id'])){
            $sql="select * from events ORDER BY b_id DESC";
            $result=mysqli_query($con,$sql) or die(mysqli_error($con));?>
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-table"></i>
                    Events
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>S.No</th>
                                <th>User Name</th>
                                <th>Title</th>
                                <th>Date</th>
                                <th>S Time</th>
                                <th>E Time</th>
                                <th>Place</th>
                                <th>IsBooked</th>
                                <th>Price</th>
                                <th>Adv Amnt</th>
                                <th>Bal Amnt</th>
                                <th>Tot Amt</th>
                                <th>User Status</th>
                                <?php 
                                if(isset($_SESSION['admin']) && $_SESSION['admin'] != ""){?>
                                <th></th><?php
                                }?>
                            </tr>
                            </thead>
                            <tbody><?php
                            $i=1;
                            while($row=mysqli_fetch_array($result)){?>
                                <tr style="text-align:center;">
                                <td><?php echo $i;?></td>
                                <td><?php echo $row['user_name'];?></td>
                                <td><?php echo $row['e_title'];?></td>
                                 <td><?php $d=date_create($row['e_date']);
                                        $date = date_format($d,"d/m/Y");
                                        echo $date;
                                        ?></td>
                                <td><?php echo $row['s_time'];?></td>
                                <td><?php echo $row['e_time'];?></td>
                                <td><?php echo $row['e_place'];?></td>
                                <td><?php echo $row['IsBooked'];?></td>
                                <td><?php echo $row['price'];?></td>
                                <td><?php echo $row['advance_amount'];?></td>
                                <td><?php echo $row['Balance'];?></td>
                                <td><?php echo $row['total_amount'];?></td>
                                <td>
                                            <?php if($row['user_status']=="1"){ echo "<span style='color:red;'>Cancelled</span>";  } else { echo "<span style='color:green;'>Booked</span>"; } ?> </td>
                                <?php 
                                if(isset($_SESSION['admin']) && $_SESSION['admin'] != ""){?>
                                <td><a href="update_event.php?b_id=<?php echo $row['b_id'];?>" class="badge btn-primary btn-xs">Upd Amt</a></td>
                                <td>
                                    <?php if($row['user_status']=="1"){ echo "<span style='color:red;'>Event Cancelled By User.</span>";
                                    } else { ?>
                                    <?php if($row['IsBooked']=="accepted"){ echo "<span style='color:green;font-weight:bold;'>Accepted</span>"; }elseif($row['IsBooked']=="declined"){ echo "<span style='color:red;font-weight:bold;'>Declined</span>"; }else{ ?><a href="waiting.php?b_id=<?php echo $row['b_id'];?>"><a href="accept_event.php?b_id=<?php echo $row['b_id'];?>" class="badge btn-success btn-xs">Accept</a>
                                    <a href="decline_event.php?b_id=<?php echo $row['b_id'];?>" class="badge btn-danger btn-xs">Decline</a></a><?php } } ?>


                                    
                                </td><?php
                                }?>
                                </tr><?php	
                            $i++; 
                            } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <a href="admin_dashboard.php" class="nav-link">
                    <i class="nav-icon fas fa-inbox"></i> Back
                </a>
            </div><?php
        }
        include('footer.php');?>
