<?php include 'header.php'; ?>
<marquee><h2 style="margin-top: 100px;">Welcome <?php echo $_SESSION['user_name'];?>	</h2></marquee><?php
$msg="";
if(isset($_GET['u_id'])){
    if(isset($_POST['add_event'])){
        $title_sql = "select event_name from our_events where event_id= '".$_POST['event_id']."'";
        $res_title=mysqli_query($con,$title_sql) or die(mysqli_error($con));
        $ins_title=mysqli_fetch_array($res_title);

        $price_id_sql = "select price from pricing where price_id= '".$_POST['price_id']."'";
        $res_price_id=mysqli_query($con,$price_id_sql) or die(mysqli_error($con));
        $ins_price_id=mysqli_fetch_array($res_price_id);
        


        $start_date = date_create($_POST['e_date']);
        $date = date_format($start_date, "Y-m-d");

        $sql="insert into events(event_id, package_id, price_id, e_title, e_date, s_time, e_time, e_place, price, u_id, user_name,user_status)
        values('".$_POST['event_id']."','".$_POST['package_id']."','".$_POST['price_id']."','".$ins_title['event_name']."','".$date."','".$_POST['s_time']."','".$_POST['e_time']."','".$_POST['e_place']."','".$ins_price_id['price']."','".$_SESSION['user_id']."','".$_SESSION['user_name']."','0')";
        $res=mysqli_query($con,$sql) or die(mysqli_error($con));
        if($res){
            $msg="Booking Detail Added Successfully. Please Wait for Confirmation";
            
        }
    }

?>

<div class="container" style="margin:0 auto;padding-top:30px;padding-bottom:30px;">
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <div class="card">
        <h5 class="card-header">Book Now</h5>
        <div class="card-body">
           <?php if($msg) {?>
            <div class="alert alert-success"><?php echo $msg; ?></div><?php
            }
              if(isset($_POST['add_event'])){ 
                    $sql_id = "select b_id from events order by b_id DESC limit 1";
                    $result_sql_id=mysqli_query($con,$sql_id) or die(mysqli_error($con));
                    $row_id=mysqli_fetch_array($result_sql_id);?>
                        <a href="waiting.php?b_id=<?php echo $row_id['b_id'];?>" class="btn btn-primary">Check Event Accepted Or Declined</a><?php
                    
              }else{?>
             
            <form  id="basicform" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="inputUserName">Event Name</label><?php
                        $i = 1;
                        $sql_events="select * from our_events";
                        $result_events=mysqli_query($con,$sql_events) or die(mysqli_error());?>
                        <select name="event_id" id="our_events" class="form-control" required="required" onchange="package_selection(this.value)">
                        <option value="0">Select Event</option><?php
                        while($row_e=mysqli_fetch_array($result_events)){?>
                            <option value="<?php echo $row_e['event_id']; ?>"><?php echo $row_e['event_name']; ?>
                            </option>
                            <?php
                            $i++;
                        }?>
                        </select>
                        
                    </div>
                    <div class="form-group" id="package_div_id">
                        <label for="inputUserName">Package Name</label><?php
                        $j = 1;
                        $sql_package="select * from packages";
                        $result_package=mysqli_query($con,$sql_package) or die(mysqli_error());?>
                        <select placeholder="select" name="package_id" id="packages" class="form-control" required="required" onchange="price_selection(this.value)">
                        <option data-option="0" selected value="0">Select Package</option><?php
                        while($row_package=mysqli_fetch_array($result_package)){?>
                            <option data-option="<?php echo $row_package['event_id']; ?>" value="<?php echo $row_package['package_id']; ?>"><?php echo $row_package['package_name']; ?></option><?php
                            $j++;
                        }?>
                        </select>
                        
                    </div>

                    <div class="form-group" id="price_div_id">
                        <label for="inputUserName">Prices</label><?php
                        $k = 1;
                        $sql_price="select * from pricing";
                        $result_price=mysqli_query($con,$sql_price) or die(mysqli_error());?>
                        <select name="price_id" id="prices" class="form-control" required="required">
                        <option data-option="1" value="2">Select Price</option><?php
                        while($row_price=mysqli_fetch_array($result_price)){?>
                            <option data-option="<?php echo $row_price['package_id']; ?>" value="<?php echo $row_price['price_id']; ?>"><?php echo $row_price['price']; ?></option><?php
                            $k++;
                        }?>
                        </select>
                        
                    </div>
                 <div class="form-group">
                    <label for="inputUserName">Event Date</label>
                    <input id="inputUserName" type="date" name="e_date" required="required"  class="form-control">
                </div>
				<div class="form-group">
                    <label for="inputUserName">Start Time</label>
                    <input id="inputUserName" type="text" name="s_time" required="required"  class="form-control">
                </div>
                <div class="form-group">
                    <label for="inputUserName">End Time</label>
                    <input id="inputUserName" type="text" name="e_time" required="required"  class="form-control">
                </div>
				  <div class="form-group">
                    <label for="inputUserName">Event Place</label>
                    <input id="inputUserName" type="text" name="e_place" required="required"  class="form-control">
                </div>
            
                <div class="row">
                    <div class="col-sm-6 pl-0">
                    </div>
                    <div class="col-sm-6 pl-0">
                        <p class="text-right">
                            <input type="submit" class="btn btn-space btn-primary" value="Add Event" name="add_event">
                            <button type="reset" class="btn btn-space btn-secondary">Cancel</button>
                        </p>
                    </div>
                </div>
            </form><?php
              }?>
        </div>
        <a href="dashboard.php" class="nav-link">
            <i class="nav-icon fas fa-inbox"></i> Back
        </a>
    </div>
</div>
</div>
<?php } else { header("Location:user_login.php");} ?>
<script>
var our_events = document.querySelector('#our_events');
var packages = document.querySelector('#packages');
var packages2 = packages.querySelectorAll('option');

var prices = document.querySelector('#prices');
var prices2 = prices.querySelectorAll('option');



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
function price_selection(selValue) {

    prices.innerHTML = '';
    var optionEmptyPrice = document.createElement("option");
    optionEmptyPrice.text = "Select Price";
    optionEmptyPrice.value = "0";
    prices.appendChild(optionEmptyPrice);
    for(var i = 0; i < prices2.length; i++) {
        if(prices2[i].dataset.option === selValue) {
            prices.appendChild(prices2[i]);
        }
    }
}

package_selection(packages.value);
price_selection(prices.value);
</script><?php
include('footer.php');?>