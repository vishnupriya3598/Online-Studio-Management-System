<?php
		include ('header.php');
		include ('phpqrcode/qrlib.php');
        
        if(isset($_POST['mobile'])){
            /* For OTP */
            
            
                $otp = rand(1000,9999);
                $mobile = $_POST['mobile'];
                $fields = array(
                    "variables_values" => $otp,
                    "route" => "otp",
                    "numbers" => $mobile,
                );
                
                $sql = "insert into otp(otp,created)values('".$otp."','".date("Y-m-d H:i:s")."')";
                $res = mysqli_query($con,$sql);
                $current_id = mysqli_insert_id($con);
                if($res){
                    $_SESSION['mobile'] =  $_POST['mobile'];
                    header('Location:otp.php?id='.$current_id.'&event_id='.$_GET['event_id']);
                }
            
                $curl = curl_init();
            
                curl_setopt_array($curl, array(
                CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($fields),
                CURLOPT_HTTPHEADER => array(
                    "authorization: AteTGYEM6fnU3O5uKLIPzWcBvmyo4jwkpVaXiSH9Zh1CqNlsF0WXVjMZKxzSp3OBT50nckdyvsDEglfH",
                    "accept: */*",
                    "cache-control: no-cache",
                    "content-type: application/json"
                ),
                ));
            
                $response = curl_exec($curl);
                $err = curl_error($curl);
            
                curl_close($curl);
            
                if (isset($err) && $err != "") {
                    echo "cURL Error #:" . $err;
                }else{
                    echo $response;
                }
            }?>
        <marquee><h2 style="margin-top: 100px;">Welcome <?php echo $_SESSION['user_name'];?>	</h2></marquee>
    <div class="container" style="margin:0 auto;padding-top:50px;padding-bottom:50px;">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

            <div class="card mb-3">
                <h5 class="card-header">SCAN QR CODE</h5>
                    <div class="card-body"><?php
                        $id = $_GET['b_id'];
                        $sql="select * from events where b_id='".$id."'";
                        $result=mysqli_query($con,$sql) or die(mysqli_error($con));
                        $data=mysqli_fetch_array($result); 
                        $text = $data['advance_amount']. ' rs';
                    
                        // $path variable store the location where to 
                        // store image and $file creates directory name
                        // of the QR code file by using 'uniqid'
                        // uniqid creates unique id based on microtime
                        $path = 'images/';
                        $file = $path.uniqid().".png";
                        
                        // $ecc stores error correction capability('L')
                        $ecc = 'XS';
                        $pixel_Size = 5;
                        $frame_Size = 5;
                        
                        // Generates QR Code and Stores it in directory given
                        QRcode::png($text, $file, $ecc, $pixel_Size, $frame_Size); ?>
                        <div class="col-md-3">
                            <?php   echo "<center><img src='".$file."'></center>"; ?>
                        </div>
                    </div>



                    <div class="card-body"><?php
                    ?>
                    
                    <form method="post">
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="">
                                        <input type="text" name="mobile" class="form-control" placeholder="Mobile Number" required="required" autofocus="autofocus">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <input type="submit" class="btn btn-primary " value="Submit" name="login">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><?php
?>
    
    
        