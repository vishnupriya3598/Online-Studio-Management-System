<?php include 'header.php'; ?>
<marquee><h2 style="margin-top: 100px;">Welcome <?php echo $_SESSION['admin'];?>	</h2></marquee><?php
$msg="";
if(isset($_SESSION['admin_id'])){
    if(isset($_GET['price_id'])){
    $sql="delete from pricing where price_id='".$_GET['price_id']."'";
    $result=mysqli_query($con,$sql) or die(mysqli_error($con));
    
    if(isset($result))
    {
        $msg = "Price Deleted Successfully";
    }
    }?>
<div class="container" style="margin:0 auto;padding-top:30px;">
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <div class="card">
        <h5 class="card-header">Delete</h5>
        <div class="card-body">
           <?php if($msg) {?>
            <div class="alert alert-success"><?php echo $msg; ?></div>
             <?php } ?>
            
        </div>
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Price List</div>
			
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Price ID</th>
					<th>Event ID</th>
                    <th>Package ID</th>
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
                    <td><?php echo $row['price_id'];?></td>
                    <td><?php echo $row['event_id'];?></td>
                    <td><?php echo $row['package_id'];?></td>
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
    </div>
    <a href="admin_dashboard.php" class="nav-link">
        <i class="nav-icon fas fa-inbox"></i> Back
    </a>
</div>
</div>


    

<?php } else { header("Location:login.php");}?><?php include 'footer.php';?>