<?php
include('header.php');
session_start();
if(isset($_GET['id'])){
	$id=$_GET['id'];
			 $sql = "update events set  user_status='1' WHERE b_id='".$id."' ";
  	$res= mysqli_query($con, $sql);
  	if ($res) {
		  header("location: booking_details.php?u_id=".$_GET['u_id']); 
		  
		  }
	}

?>