<?php include 'header.php';
$msg="";

    if(isset($_POST['register'])){
        $sql="select * from user where mobile='".$_POST['mobile']."'";
        $result=mysqli_query($con,$sql) or die(mysqli_error());
        $ins=mysqli_fetch_array($result);
        if($ins)
        {
            $msg = "User Alread Exist";
        }
        else
        {
            $sql="insert into user(user_name,email,mobile,address,user_id,password)
            values('".$_POST['user_name']."','".$_POST['email']."','".$_POST['mobile']."','".$_POST['address']."','".$_POST['user_id']."','".$_POST['password']."')";
            $res=mysqli_query($con,$sql) or die(mysqli_error($con));
            if($res){
                $msg="Registered Successfully.";
                header("Location:user_login.php");
            }
                    
        }

    }

?>
<marquee><h2 style="margin-top: 100px;">Welcome	</h2></marquee>
<div class="container" style="margin:0 auto;padding-top:30px;padding-bottom:30px;">
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <div class="card">
        <h5 class="card-header">Register</h5>
        <div class="card-body">
           <?php if($msg) {
              ?>                <div class="alert alert-success"><?php echo $msg; ?></div>
             <?php } ?>
            <form  id="basicform" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="inputUserName">User Name</label>
                    <input id="inputUserName" type="text" name="user_name" required="required"  class="form-control">
                </div>
                <div class="form-group">
                    <label for="inputUserName">Email Id</label>
                    <input id="inputUserName" type="email" name="email" required="required"  class="form-control">
                </div>
                <div class="form-group">
                    <label for="inputUserName">Mobile</label>
                    <input id="inputUserName" type="tel" name="mobile" required="required"  class="form-control">
                </div>
                <div class="form-group">
                    <label for="inputUserName">Address</label>
                    <textarea name="address" class="form-control" required="required"></textarea>  
                </div>
				<div class="form-group">
                    <label for="inputUserName">User ID</label>
                    <input id="inputUserName" type="text" name="user_id" required="required"  class="form-control">
                </div>
				<div class="form-group">
                    <label for="inputUserName">Password</label>
                    <input id="inputUserName" type="password" name="password" required="required"  class="form-control">
                </div>
                
                <div class="row">
                    <div class="col-sm-6 pl-0">
                    </div>
                    <div class="col-sm-6 pl-0">
                        <p class="text-right">
                            <input type="submit" class="btn btn-space btn-primary" value="Register" name="register">
                            <button type="reset" class="btn btn-space btn-secondary">Cancel</button>
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div><?php include 'footer.php';?>