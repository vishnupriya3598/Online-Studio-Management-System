<?php include 'header.php'; ?>
<marquee><h2 style="margin-top: 100px;">Welcome <?php echo $_SESSION['admin'];?>	</h2></marquee><?php
$msg="";
if(isset($_SESSION['admin_id'])){
if(isset($_POST['add_price'])){

$sql="select * from pricing where price_id='".$_POST['price_id']."'";
$result=mysqli_query($con,$sql) or die(mysqli_error($con));
$ins=mysqli_fetch_array($result);
if($ins)
{
	$msg = "Price Already Exist";
}
else
{
    $event_sql = "select * from our_events where event_id = '".$_POST['event_id']."'";
    $res_event=mysqli_query($con,$event_sql) or die(mysqli_error($con));
    $ins_event=mysqli_fetch_array($res_event);

    $package_sql = "select * from packages where package_id = '".$_POST['package_id']."'";
    $res_package=mysqli_query($con,$package_sql) or die(mysqli_error($con));
    $ins_package=mysqli_fetch_array($res_package);

	$sql="insert into pricing(price_id, event_id, package_id, event_name, package_name, price)
    values('".$_POST['price_id']."','".$_POST['event_id']."','".$_POST['package_id']."','".$ins_event['event_name']."','".$ins_package['package_name']."','".$_POST['price']."')";
    $res=mysqli_query($con,$sql) or die(mysqli_error($con));
    if($res){
        $msg="Pricing Added Successfully.";
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
                        <label for="inputUserName">Event Name</label><?php
                        $i = 1;
                        $sql_events="select * from our_events";
                        $result_events=mysqli_query($con,$sql_events) or die(mysqli_error());?>
                        <select name="event_id" id="our_events" class="form-control" required="required" onchange="package_selection(this.value)">
                        <option value="0">Select Event</option><?php
                        while($row_e=mysqli_fetch_array($result_events)){?>
                            <option value="<?php echo $row_e['event_id']; ?>"><?php echo $row_e['event_name']; ?></option><?php
                            $i++;
                        }?>
                        </select>
                        
                    </div>
                    <div class="form-group">
                        <label for="inputUserName">Package Name</label><?php
                        $j = 1;
                        $sql_package="select * from packages";
                        $result_package=mysqli_query($con,$sql_package) or die(mysqli_error());?>
                        <select name="package_id" id="packages" class="form-control" required="required">
                        <option value="0" selected data-option="0">Select Package</option><?php
                        while($row_package=mysqli_fetch_array($result_package)){?>
                            <option data-option="<?php echo $row_package['event_id']; ?>" value="<?php echo $row_package['package_id']; ?>"><?php echo $row_package['package_name']; ?></option><?php
                            $j++;
                        }?>
                        </select>
                        
                    </div>
                    <div class="form-group">
                        <label for="inputUserName">Price ID</label>
                        <input id="inputUserName" type="text" name="price_id" required="required"  class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="inputUserName">Price</label>
                        <input id="inputUserName" type="text" name="price" required="required"  class="form-control">
                    </div>
                
                    <div class="row">
                        <div class="col-sm-6 pl-0"></div>
                        <div class="col-sm-6 pl-0">
                            <p class="text-right">
                                <input type="submit" class="btn btn-space btn-primary" value="Add Price" name="add_price">
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
                                <th>Price ID</th>
                                <th>Event Name</th>
                                <th>Package Name</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $i = 1;
                            $sql="select * from pricing";
                            $result=mysqli_query($con,$sql) or die(mysqli_error());
                            while($row=mysqli_fetch_array($result)){?>
                            <tr style="text-align:center;">
                                <td><?php echo $i;?></td>
                                
                                <td><?php echo $row['event_id'];?></td>
                                <td><?php echo $row['package_id'];?></td>
                                <td><?php echo $row['price_id'];?></td>
                                <td><?php echo $row['event_name'];?></td>
                                <td><?php echo $row['package_name'];?></td>
                                <td><?php echo $row['price'];?></td><?php 
                                if(isset($_SESSION['admin']) && $_SESSION['admin'] != ""){?>
                                    <td><a href="delete_price.php?price_id=<?php echo $row['price_id'];?>" class="btn btn-danger">Delete</a></td><?php
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
<?php } else { header("Location:login.php");}?>
<script>
var our_events = document.querySelector('#our_events');
var packages = document.querySelector('#packages');
var packages2 = packages.querySelectorAll('option');

function package_selection(selValue) {
    packages.innerHTML = '';
    var option = document.createElement("option");
option.text = "Select Package";
option.value = "0";
packages.appendChild(option);
  for(var i = 0; i < packages2.length; i++) {
    if(packages2[i].dataset.option === selValue) {
        packages.appendChild(packages2[i]);
    }
  }
}

package_selection(packages.value);
</script>
<?php include 'footer.php';?>