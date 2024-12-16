<?php include 'header.php'; ?>
<marquee><h2 style="margin-top: 100px;">Welcome <?php echo $_SESSION['admin'];?>	</h2></marquee><?php
$msg="";
if(isset($_SESSION['admin_id'])){
if(isset($_POST['add_package'])){
$sql="select * from packages where package_id='".$_POST['package_id']."'";
$result=mysqli_query($con,$sql) or die(mysqli_error($con));
$ins=mysqli_fetch_array($result);
if($ins)
{
	$msg = "Package Already Exist";
}
else
{
    
	$sql="insert into packages(event_id, package_id, package_name)
    values('".$_POST['event_id']."','".$_POST['package_id']."','".$_POST['package_name']."')";
    $res=mysqli_query($con,$sql) or die(mysqli_error($con));
    if($res){
        $msg="Package Added Successfully.";
    }

}
}?>
<div class="container" style="margin:0 auto;padding-top:30px;">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header">Add Pricing</h5>
            <div class="card-body">
            <?php if($msg) {?>
                <div class="alert alert-success"><?php echo $msg; ?></div>
                <?php } ?>
                <form  id="basicform" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="inputUserName">Event ID</label><?php
                        $i = 1;
                        $sql_events="select * from our_events";
                        $result_events=mysqli_query($con,$sql_events) or die(mysqli_error());?>
                        <select name="event_id" id="our_events" class="form-control" required="required">
                        <option value="">Select Event</option><?php
                        while($row_e=mysqli_fetch_array($result_events)){?>
                            <option value="<?php echo $row_e['event_id']; ?>"><?php echo $row_e['event_name']; ?></option><?php
                            $i++;
                        }?>
                        </select>
                        
                    </div>
                    <div class="form-group">
                        <label for="inputUserName">Package ID</label>
                        <input id="inputUserName" type="text" name="package_id" required="required"  class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="inputUserName">Package Name</label>
                        <input id="inputUserName" type="text" name="package_name" required="required"  class="form-control">
                    </div>
                
                    <div class="row">
                        <div class="col-sm-6 pl-0"></div>
                        <div class="col-sm-6 pl-0">
                            <p class="text-right">
                                <input type="submit" class="btn btn-space btn-primary" value="Add Package" name="add_package">
                                <button type="reset" class="btn btn-space btn-secondary">Cancel</button>
                            </p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                Price List
            </div> 
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Event ID</th>
                                <th>Package ID</th>
                                <th>Package Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $i = 1;
                            $sql="select * from packages";
                            $result=mysqli_query($con,$sql) or die(mysqli_error());
                            while($row=mysqli_fetch_array($result)){?>
                            <tr style="text-align:center;">
                                <td><?php echo $i;?></td>
                                <td><?php echo $row['event_id'];?></td>
                                <td><?php echo $row['package_id'];?></td>
                                <td><?php echo $row['package_name'];?></td><?php 
                                if(isset($_SESSION['admin']) && $_SESSION['admin'] != ""){?>
                                    <td><a href="delete_package.php?package_id=<?php echo $row['package_id'];?>" class="btn btn-danger">Delete</a></td><?php
                                }?>
                            </tr><?php	
                            $i++;
                            }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <a href="admin_dashboard.php" class="nav-link">
            <i class="nav-icon fas fa-inbox"></i> Back
        </a>
    </div>
</div>  
<?php } else { header("Location:login.php");}?><?php include 'footer.php';?>