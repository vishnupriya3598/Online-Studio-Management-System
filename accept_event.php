<?php
include('header.php'); ?>
<marquee><h2 style="margin-top: 100px;">Welcome <?php echo $_SESSION['admin'];?>	</h2></marquee><?php
if(isset($_GET['b_id'])){
    $msg = "";
   
    $sql="update events set IsBooked = 'accepted' where b_id='".$_GET['b_id']."'";
    $res=mysqli_query($con,$sql) or die(mysqli_error($con));
    if($res){
        $msg="Event Accepted";
    }?>
    <div class="container" style="margin:0 auto;padding-top:30px;padding-bottom:30px;">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
          <h5 class="card-header">Confirmation</h5>
          <div class="card-body">
            <?php if($msg) {?>
            <div class="alert alert-success"><?php echo $msg; ?></div>
            <?php } ?>
          </div>
        </div>
        <a href="confirmation.php" class="nav-link">
            <i class="nav-icon fas fa-inbox"></i> Back
        </a>
      </div>
    </div><?php
}
include('footer.php');
?>