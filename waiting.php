<?php include 'header.php'; ?>
<marquee><h2 style="margin-top:100px;">Welcome <?php echo $_SESSION['user_name'];?>	</h2></marquee><?php
if(isset($_GET['b_id'])){
    $msg = "";
    $id= $_GET['b_id'];
    $sql="select * from events where b_id='".$id."'";
    $result=mysqli_query($con,$sql) or die(mysqli_error($con));
    $ins=mysqli_fetch_array($result);
    
    if($ins["IsBooked"] == "accepted"){
        $msg = "Event Accepted";
    }elseif($ins["IsBooked"] == "waiting"){
        $msg="Wait For Confirmation";
    }else{
        $msg="Event Declined";
    }
    
    if($ins["IsBooked"] == "accepted"){
        if(isset($_POST["pay_advance"])){
            $msg="Scan QR Code and Pay Amount";
        }
        
    }?>
    
    <div class="container" style="margin:0 auto;padding-top:30px;padding-bottom:30px;">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Book Appointment</h5>
                <div class="card-body"><?php
                    if($msg) {?>
                        <div class="alert alert-success"><?php echo $msg; ?></div><?php
                    }
                    if($ins["IsBooked"] == "waiting"){?>
                        <div class="alert"> To check confirmation reload the page </div><?php
                    }
                    if($ins["IsBooked"] == "accepted"){
                        if(isset($_POST["pay_advance"])){
                            
                            /* To update advance amount */
                            $sql="update events set advance_amount = '".$_POST["advance"]."' where b_id='".$_GET['b_id']."'";
                            $res=mysqli_query($con,$sql) or die(mysqli_error($con));
                            
                            /* To get balance amount */
                            $sql1 = "select price,advance_amount from events where b_id='".$_GET['b_id']."'";
                            $res1=mysqli_query($con,$sql1) or die(mysqli_error($con));
                            $ins1=mysqli_fetch_array($res1);
                            
                            /* To update balance amount */
                            $balance_amount = $ins1['price']-$ins1['advance_amount'];
                            
                            $sql3="update events set Balance = '".$balance_amount."' where b_id='".$_GET['b_id']."'";
                            $res3=mysqli_query($con,$sql3) or die(mysqli_error($con));
                            
                            /*if($res){
                                $msg="Advance Paid";
                            }*/?>
                            <div style="text-align:right;color: blue">
                                <a style="text-align:right;color: blue" href="scan.php?b_id=<?php echo $_GET['b_id'];?>">SCAN QR CODE</a>
                            </div>
                        
                            <a href="dashboard.php" class="nav-link">
                                <i class="nav-icon fas fa-inbox"></i> Back
                            </a><?php
                        }else{
                            $sql="select price from events where event_id='".$id."'";
                            $result=mysqli_query($con,$sql) or die(mysqli_error($con));
                            $ins=mysqli_fetch_array($result);?>
                            <form  id="moneyform" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="inputPayAdvance">Pay Advance Amount </label>
                                    <input id="inputPayAdvance" type="text" name="advance" required="required"  class="form-control">
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 pl-0">
                                    </div>
                                    <div class="col-sm-6 pl-0">
                                        <p class="text-right">
                                            <input type="submit" class="btn btn-space btn-primary" value="Pay Advance" name="pay_advance">
                                            <button type="reset" class="btn btn-space btn-secondary">Cancel</button>
                                        </p>
                                    </div>
                                </div>
                            </form><?php
                        }
                    }?>
                </div>
            </div>
            <a href="dashboard.php" class="nav-link">
                <i class="nav-icon fas fa-inbox"></i> Back
            </a>
        </div>
    </div><?php
} else { header("Location:login.php");}
include('footer.php');?>