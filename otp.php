<?php include('header.php'); ?>
<marquee><h2 style="margin-top: 100px;">Welcome <?php echo $_SESSION['user_name'];?>	</h2></marquee><?php
$msg="";
  if(isset($_POST['login'])) {
    $otp = $_POST['otp'];

    $sql = "select * from otp where otp_id='".$_GET['id']."' ";
    $res = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($res);
    $rr = $row['otp'];
    if($row){
      if($rr==$otp){
      $msg = "Your Payment was done.";
      header('Location:dashboard.php?event_id='.$_GET['event_id']);
      }else{
        $msg = "Invalid OTP";
        header('Location:otp.php?id='.$_GET['id']);
        
      }
    } 
  }?>
 
<div class="container" style="margin:0 auto;padding-top:50px;padding-bottom:50px;">
  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

    <div class="card mb-3">
        <div class="card-body">
          <form method="post">
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <div class="">
                    <input type="text" name="otp" class="form-control" placeholder="Enter OTP" required="required" autofocus="autofocus">
                  </div>
                </div>
              </div>
            </div>
            <input type="submit" class="btn btn-primary " value="SUBMIT" name="login">
          </form>
      </div>
    </div>
  </div>
</div><?php
include('footer.php'); ?>