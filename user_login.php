<?php
include('header.php'); 
$msg="";
if(isset($_SESSION['user_id'])){
  header("Location:dashboard.php");
}
else
{
 if(isset($_POST['login'])){
    $sql = "select * from user where user_id='".$_POST['user_id']."' AND password='".$_POST['password']."'";
    $res= mysqli_query($con, $sql);
    $row=mysqli_fetch_array($res);
      if($row){
          $_SESSION['user_name'] = $row['user_name'];
          $_SESSION['user_id'] = $row['u_id'];
          header("location: dashboard.php");
      }else{
        $msg="Sorry! Enter Valid Username and Password";
      }
   
 }
}
?>
<marquee><h2 style="margin-top: 100px;">Welcome	</h2></marquee>
<div class="container" style="margin:0 auto;padding-top:30px;padding-bottom:30px;">
  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

    <h2 style="padding-bottom:20px;">User Login</h2>
    <?php if($msg) { ?><div class="alert alert-danger"><?php echo $msg;?></div> <?php } ?>
    <form class="form-horizontal" method="post">
      <div class="form-group">
        <label class="control-label col-sm-2" for="userid">User ID:</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="userid"  name="user_id">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="pwd">Password:</label>
        <div class="col-sm-10">          
          <input type="password" class="form-control" id="pwd"  name="password">
        </div>
      </div>
      <div class="form-group">        
        <div class="col-sm-offset-2 col-sm-10">
          <input type="submit" class="btn btn-success" value="User Login" name="login">
        </div>
      </div>
    </form>
  </div>
</div>
<style>

.btn {
    display: inline-block;
    margin-bottom: 0;
    font-weight: 400;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    background-image: none;
    border: 1px solid transparent;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    border-radius: 4px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}
.btn-success {
    color: #fff;
    background-color: #5cb85c;
    border-color: #4cae4c;
}
</style>

<?php include 'footer.php';?>