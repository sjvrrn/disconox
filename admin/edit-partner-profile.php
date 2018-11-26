
<?php
error_reporting(0);
require_once("header.php");
if(isset($_GET['ei'])){
    $partner_id = base64_decode($_GET['ei']);
    /*start*/
    $data = array(
        "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
        "userid"=>$partner_id
    );
    $data_json = json_encode($data);
    $ur = $url."userDetails";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $ur);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $response  = curl_exec($ch);
    if ($response === false) {
        $info = curl_getinfo($ch);
        curl_close($ch);
        die('error occured during curl exec. Additioanl info: ' . var_export($info));
    } else {

        $responsObj = json_decode($response, TRUE);
        if ($responsObj["error"]) {
            echo "Bad Request";
        } else {
            $message = $responsObj['message']; 
            $partnerDetails = $responsObj['UserDetails'];
            $name = explode("_",$partnerDetails['name']);
            $address = explode(",",$partnerDetails['address']);
        }
    }
    curl_close($ch);
    /*end*/

}
/*delete partner*/
if(isset($_GET['di'])){
    $partner_id = base64_decode($_GET['di']);
    /*start*/
    $data = array(
        "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
        "userid"=>$partner_id
    );
    $data_json = json_encode($data);
    $ur = $url."userDelete";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $ur);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $response  = curl_exec($ch);


    if ($response === false) {
        $info = curl_getinfo($ch);
        curl_close($ch);
        die('error occured during curl exec. Additioanl info: ' . var_export($info));
    } else {

        $responsObj = json_decode($response, TRUE);

        if ($responsObj["error"]) {
            echo "Bad Request";
        } else {
            $message = $responsObj['message'];
           echo"<script>alert('".$message."');</script";
           header("location:partners.php");
        }
    }
    curl_close($ch);
    /*end*/

}
/*activate user*/
/*activate user*/
if(isset($_GET['du'])){
         $partner_id = base64_decode($_GET['du']);
         $status    = base64_decode($_GET['us']);
    /*start*/
    $data = array(
        "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
        "userid"=>$partner_id,
        "status"=>$status
    );
    $data_json = json_encode($data);
    $ua = $url."activateUser";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $ua);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $response  = curl_exec($ch);
    if ($response === false) {
        $info = curl_getinfo($ch);
        curl_close($ch);
        die('error occured during curl exec. Additioanl info: ' . var_export($info));
    } else {

        $responsObj = json_decode($response, TRUE);

        if ($responsObj["error"]) {
            echo "Bad Request";
        } else {
            $message = $responsObj['message'];
            echo"<script>alert('".$message."');</script>";
            header("location:partners.php");
        }
    }
    curl_close($ch);
    /*end*/

}

/*submit*/
if(isset($_POST['submit'])){
    /*start*/
/*image start*/ 
        $target_path = "assets/uploads/";
        $validextensions = array("jpeg", "jpg", "png");
        $ext = explode('.', basename($_FILES['image']['name']));
        $file_extension = end($ext);
        $target_path = $target_path . md5(uniqid()) . "." . $ext[count($ext) - 1];
		 if (($_FILES["image"]["size"]< 10000000)
            && in_array($file_extension, $validextensions)) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
                $image = $target_path; 
                //echo $j. ').<span id="noerror">Image uploaded successfully!.</span><br/><br/>';
            } else {
                //echo $j. ').<span id="error">please try again!.</span><br/><br/>';
            }
        } else {
            //echo $j. ').<span id="error">***Invalid file Size or Type***</span><br/><br/>';
        }
/*image end*/
   if(isset($_GET['ei'])){
       $data = array(
           "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
           "userid"=>base64_decode($_GET['ei']),
           "name"=>$_POST["first_name"] .'_'.$_POST['last_name'],
           "password"=>$_POST["password"],
           "phone"=>$_POST["phone"],
           "email"=>$_POST["email"],
           "address"=>$_POST["street"].','.$_POST["city"].','.$_POST["state"],
		   "image"=>$target_path
             );
       $uu = $url."userUpdate";
   }else{
       $data = array(
        "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
           "name"=>$_POST["first_name"].'_'.$_POST['last_name'],
           "password"=>$_POST["password"],
           "phone"=>$_POST["phone"],
           "email"=>$_POST["email"],
           "address"=>$_POST["street"].','.$_POST["city"].','.$_POST["state"],
		   "image"=>$target_path,
           "role"=>2
		          );
	   
       $uu = $url."registration";
   }-
       $data_json = json_encode($data);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $uu);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $response  = curl_exec($ch);print_r($response); exit;

    if ($response === false) {
        $info = curl_getinfo($ch);
        curl_close($ch);
        die('error occured during curl exec. Additioanl info: ' . var_export($info));
    } else {

        $responsObj = json_decode($response, TRUE); 
        if ($responsObj["error"]) {
            echo "Bad Request";
        } else {
            $message = $responsObj['message'];
           echo"<script>alert('".$message."');</script>";
           if(isset($_GET['ei'])){
               header("location:edit-partner-profile.php?ei=".$_GET['ei']);
           }else{
               header("location:partners.php");
           }

        }
    }
    curl_close($ch);
    /*end*/
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>Disconox</title>
<?php require_once ("header.php");?>
</head>
<body class="fix-header card-no-border">
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <div id="main-wrapper">
       <?php 
require_once("top.php");	   
       require_once ("left-sidebar.php");?>
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Dashboard</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Partners</li>
							<li class="breadcrumb-item active">Partner Profile Details</li>
                        </ol>
                    </div>
                    <div class="col-md-7 col-4 align-self-center">
                        <div class="d-flex m-t-10 justify-content-end">
                            <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                                <div class="chart-text m-r-10">
                                    <h6 class="m-b-0"><small>THIS MONTH</small></h6>
                                    <h4 class="m-t-0 text-info"><i class="fa fa-inr flt-left p-t3"></i> 0</h4></div>
                                <div class="spark-chart">
                                    <div id="monthchart"><canvas width="60" height="35" style="display: inline-block; width: 60px; height: 35px; vertical-align: top;"></canvas></div>
                                </div>
                            </div>
                            <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                                <div class="chart-text m-r-10">
                                    <h6 class="m-b-0"><small>LAST MONTH</small></h6>
                                    <h4 class="m-t-0 text-primary"><i class="fa fa-inr flt-left p-t3"></i> 0 </h4></div>
                                <div class="spark-chart">
                                    <div id="lastmonthchart"><canvas width="60" height="35" style="display: inline-block; width: 60px; height: 35px; vertical-align: top;"></canvas></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							 <h4 class="card-title m-b20">Selected Partner Name Comes Here</h4>
							</div>
						</div>
						<div class="row b-b">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 p-l0">
                                <h4 class="card-title1 p-t9">ID: <span><?php echo base64_decode($_GET['ei']); ?></span></h4>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 p-r0 text-right">
								<button type="button" class="btn waves-effect waves-light btn-rounded btn-info">Back</button>
							</div>
						</div>
                        <div class="card card-outline-info m-t20">
                            <div class="card-body">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="form-body">
                                        <div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group"> 
                                                    <label class="control-label">First Name</label>
                                                    <input type="text" id="first_name" name="first_name" class="form-control" placeholder="Enter First Name" required value="<?php echo $name[0];?>" >
                                                    </div>
                                            </div>
                                            <div class="col-md-6">
										
                                                <div class="form-group">
                                                    <label class="control-label">Last Name</label>
                                                    <input type="text" id="last_name" name="last_name" class="form-control form-control-danger" placeholder="Enter Last Name" required value="<?php echo $name[1];?>" required                                                    </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Email</label>
                                                    <input type="text" id="email" name="email" class="form-control form-control-danger"  value="<?php echo $partnerDetails['email'];?>" required >
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Phone Number</label>
                                                    <input type="phonenumber" id="phonenumber" name="phone" class="form-control form-control-danger" value="<?php echo $partnerDetails['phone'];?>" required maxlength=12 minlength=10 >
                                                </div>
                                            </div>
                                        </div>
										<!--
                                       <h3 class="box-title m-t10">Address</h3>
										<hr>
                                        <div class="row">
                                            <div class="col-md-12 ">
                                                <div class="form-group">
                                                    <label>Street</label>
                                                    <input type="text" class="form-control" name="street" id="street" value="<?php echo $address[0];?>">
                                                </div>
                                            </div>
                                        </div>-->
									<div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Street</label>
                                                    <input type="text" class="form-control" name="street" id="street" value="<?php echo $address[0];?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label></label>
                                                   <!-- <input type="password" class="form-control" name="cpassword" id="cpassword" <?php echo $vl;?>>-->
                                                </div>
                                            </div>
                                        </div>
										<div class='clear-fix'></div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>City</label>
                                                    <input type="text" class="form-control" name="city" id="city" required value="<?php echo $address[1];?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>State</label>
                                                    <select class="form-control" id="state" name="state">
                                                        <option>--Select your State--</option>
                                                        <option <?php if($address[2]="Telangana"){ echo"selected";} ?>>Telangana</option>
                                                        <option <?php if($address[2]="AndhraPradesh"){ echo"selected";} ?>> AndhraPradesh</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                <?php if(isset($_GET['ei'])){  $val="";}else{$val="required";} ?>
                                                    <label>Password</label>
                                                    <input type="password" class="form-control" id="password" name="password" <?php echo $val;?>>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Re Enter Password</label>
                                                    <input type="password" class="form-control" name="cpassword" id="cpassword" <?php echo $vl;?>>
                                                </div>
                                            </div>
                                      </div>
										
                                         <div class="col-md-6">
											<div class="form-actions text-right">
												<button type="submit"  name="submit" id="submit" class="btn waves-effect waves-light btn-rounded btn-success">SAVE</button>
												<button type="reset" class="btn waves-effect waves-light btn-rounded btn-info">CANCEL</button>
											</div>
										</div>
										
									</div>
								 </div>
								 </form>
                              </div>
							    
                        </div>
                    </div>
                </div>
            <div id="footer">
                 <footer>
                   <p>2017-2018 &copy; DISCONOX All Rights Reserved.</p>
                 </footer>
				 
               </div>
            </div>
        </div>
    </div>
<?php require_once ("footer.php");?>
</body>

</html>
<script>
    $(document).ready(function(){
        $(document).on("click","#delete",function(){

            alert('delete');
        });

    });

</script>