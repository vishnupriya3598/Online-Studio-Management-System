<?php include 'header.php'; ?>
<marquee><h2 style="margin-top: 100px;">Welcome <?php echo $_SESSION['admin'];?>	</h2></marquee><?php
$msg="";
if(isset($_SESSION['admin_id'])){
if(isset($_POST['add_event'])){
$sql="select * from our_events where event_id='".$_POST['event_id']."'";
$result=mysqli_query($con,$sql) or die(mysqli_error($con));
$ins=mysqli_fetch_array($result);
if($ins)
{
	$msg = "Event Name Already Exist";
}
else
{
    
	$sql="insert into our_events(event_id, event_name)
    values('".$_POST['event_id']."','".$_POST['event_name']."')";
    $res=mysqli_query($con,$sql) or die(mysqli_error($con));
    if($res){
        $msg="event Added Successfully.";
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
                        <label for="inputUserName">Event ID</label>
                        <input id="inputUserName" type="text" name="event_id" required="required"  class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="inputUserName">Event Name</label>
                        <input id="inputUserName" type="text" name="event_name" required="required"  class="form-control">
                    </div>
                
                    <div class="row">
                        <div class="col-sm-6 pl-0"></div>
                        <div class="col-sm-6 pl-0">
                            <p class="text-right">
                                <input type="submit" class="btn btn-space btn-primary" value="Add Event" name="add_event">
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
                                <th>Event Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $i = 1;
                            $sql="select * from our_events";
                            $result=mysqli_query($con,$sql) or die(mysqli_error());
                            while($row=mysqli_fetch_array($result)){?>
                            <tr style="text-align:center;">
                                <td><?php echo $i;?></td>
                                <td><?php echo $row['event_id'];?></td>
                                <td><?php echo $row['event_name'];?></td>
                                <?php 
                                if(isset($_SESSION['admin']) && $_SESSION['admin'] != ""){?>
                                    <td><a href="delete_event.php?event_id=<?php echo $row['event_id'];?>" class="btn btn-danger">Delete</a></td><?php
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