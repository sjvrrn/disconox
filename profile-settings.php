<?php 
require_once('header.php');
if(!isset($_SESSION['id'])){
header("location:index.php");
}
	//user registrationr	
		$data  = array(
           "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
           "userid"=>$_SESSION['id']
           );
		$data_json = json_encode($data);
		
	    $ud = $url."userDetails";
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $ud);
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
                $user = (object)$responsObj['UserDetails'];
                 $name = explode('-',$user->name);
                 $address = explode(",",$user->address);
                //header("location:".$_SERVER['PHP_SELF']);
            }
            curl_close($ch);
        }
	//end
//update
if(isset($_POST['update'])){
	
	/*image start*/ 
	
        $target_path = "assets/uploads/";
        $validextensions = array("jpeg", "jpg", "png");
        $ext = explode('.', basename($_FILES['images']['name']));
        $file_extension = end($ext);
        $target_path = $target_path . md5(uniqid()) . "." . $ext[count($ext) - 1];
		 if (($_FILES["images"]["size"]< 10000000)
            && in_array($file_extension, $validextensions)) {
            if (move_uploaded_file($_FILES['images']['tmp_name'], $target_path)) {
                $image = $target_path; 
               
            } else {
               
            }
        } else {
            
        } 
		
/*image end*/
	
	$password = $_POST['password'];
	$cpassword = $_POST['cpassword'];
	if($password == $cpassword)
	{
    $data  = array(
        "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
        "userid"=>$_SESSION['id'],
        "name"=>$_POST['first_name'].'-'.$_POST["last_name"],
        "address"=>$_POST['street'].','.$_POST['city'],
        "password"=>$_POST['password'],
        //"email"=>$_POST['email'],
        "phone"=>$_POST['phone'],
        "image"=>$image
    );
	
    $data_json = json_encode($data);
	
    $uu = $url."userUpdate"; 
	
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $uu);
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
			echo"<script>alert('$message');</script>";
            header("location:profile-settings.php");


        }
    }
    curl_close($ch);
     }
	 else
		{
		
		     echo "<script type='text/javascript'>
		
		     alert('Passwords do no match');
		
		      </script>";
		
	    }
//singup end
}

?>

<head>
  <meta charset="utf-8" />
  <title>DISCONOX</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta http-equiv="Content-type" content="text/html; charset=utf-8">
  <meta content="" name="description" />
  <meta content="" name="author" />
  <!-- BEGIN GLOBAL MANDATORY STYLES -->
</head>


<body class="c-layout-header-fixed">
  <!-- BEGIN: LAYOUT/HEADERS/HEADER-1 -->
  <!-- BEGIN: HEADER -->
  <?php require_once('top.php');?>
  <!-- END: HEADER -->

  <!-- BEGIN: PAGE CONTAINER -->
  <div class="c-layout-page">
    <!-- BEGIN: LAYOUT/BREADCRUMBS/BREADCRUMBS-3 -->
    <div class="c-layout-breadcrumbs-1 c-bgimage c-subtitle c-fonts-uppercase c-fonts-bold c-bg-img-center" style="background-image: url(assets/images/note-bg.jpg)">
      <div class="container">
        <div class="c-page-title">
          <p class="c-font-white">Profile Settings</p>
        </div>
      </div>

      <div class="ac-nav">
        <div class="container">
          <a href="profile-settings.php" class="btn btn-xs c-btn-green c-btn-circle c-btn-border-1x c-margin-b-10 c-font-14">Profile Settings</a>
          <a href="booking-history.php" class="btn btn-xs c-btn-white c-btn-circle c-btn-border-1x c-margin-b-10 c-font-14">Booking History</a>
          <a href="notifications.php" class="btn btn-xs c-btn-white c-btn-circle c-btn-border-1x c-margin-b-10 c-font-14">Notifications</a>
          <a href="receipts.php" class="btn btn-xs c-btn-white c-btn-circle c-btn-border-1x c-margin-b-10 c-font-14">Receipts</a>
        </div>
      </div>
    </div>
    <!-- END: LAYOUT/BREADCRUMBS/BREADCRUMBS-3 -->
    <!-- BEGIN: PAGE CONTENT -->

    <div class="c-content-box c-size-md c-bg-grey">
      <div class="container">
        <div class="row">

          <div class="col-md-4">
            <p>User Pic </p>
            <div class="profile-main">
			<?php
			if(isset($user->image) && $user->image != "")
			{
			?>
		    <img class="img-responsive img-circle" src="<?php echo $user->image; ?>" />
			<?php
			}
			else
			{
			?>
              <img class="img-responsive img-circle" src="assets/images/pro-main.jpg" />
			<?php
			}
			?>
             
            </div>
          </div>
          <div class="col-md-8">



            <p>Edit Profile</p>


            <form class="c-shop-form-1" action="" method="post" enctype="multipart/form-data">
              <!-- BEGIN: ADDRESS FORM -->
              <div class="">
                <!-- BEGIN: BILLING ADDRESS -->

                <div class="row">
                  <div class="col-md-12">
                    <div class="row">
                      <div class="form-group col-md-6">
                        <label class="control-label">First Name</label>
                        <input type="text" class="form-control c-square c-theme" id="first_name" name="first_name" placeholder="First Name" value="<?php if(isset($name[0])){ echo $name[0]; }?>"> </div>
                      <div class="col-md-6">
                        <label class="control-label">Last Name</label>
                        <input type="text" class="form-control c-square c-theme" placeholder="Last Name" name="last_name" id="last_name" value="<?php if(isset($name[1])){ echo $name[1]; }?>"> </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-6">
                    <label class="control-label">Address</label>
                    <input type="text" class="form-control c-square c-theme" placeholder="Street Address" name="street" id="street" value="<?php if(isset($address[0])) { echo $address[0]; }?>"> </div>



                  <div class="form-group col-md-6">
                    <label class="control-label">Town / City</label>
                    <input type="text" class="form-control c-square c-theme" placeholder="Town / City" name="city" id="city" value="<?php if(isset($address[1])) { echo $address[1]; }?>"> </div>
                </div>




                <div class="row">
                  <div class="col-md-12">
                    <div class="row">
                      <div class="form-group col-md-6">
                        <label class="control-label">Email Address</label>
                        <input disabled type="email" class="form-control c-square c-theme" placeholder="Email Address" name="email" id="email" value="<?php if(isset($user->email)) { echo $user->email; }?>"> </div>
                      <div class="col-md-6">
                        <label class="control-label">Phone</label>
                        <input type="tel" class="form-control c-square c-theme" placeholder="Phone" name="phone" id="phone" value="<?php if(isset($user->phone)){ echo $user->phone; }?>"> </div>
                    </div>
                  </div>
                </div>
                <!-- END: BILLING ADDRESS -->
                <!-- BEGIN: PASSWORD -->
                <div class="row">
                  <div class="form-group col-md-6">
                    <label class="control-label">Change Password</label>
                    <input type="password" class="form-control c-square c-theme" placeholder="Password" id="password" name="password" minlength="6"> </div>

                  <div class="form-group col-md-6">
                    <label class="control-label">Repeat Password</label>
                    <input type="password" class="form-control c-square c-theme" placeholder="Password" name="cpassword" id="cpassword">
                    <div class="row">
                      <div class="form-group col-md-6">
                        <label class="control-label">Profile Pic</label>
                        <input type="file" class="form-control c-square c-theme" placeholder="Profile Pid" id="images" name="images"> </div>
                    </div>


                  </div>

                  <div class="col-md-12">
                    <p class="help-block">Hint: The password should be at least six characters long.
                      <br> To make it stronger, use upper and lower case letters, numbers, and symbols like ! " ? $ % ^ &amp; ).</p>
                  </div>
                </div>
                <!-- END: PASSWORD -->
                <div class="row c-margin-t-30">

                  <div class="form-group col-md-12" role="group">
                    <button type="submit" name="update" id="update" class="btn btn-lg c-theme-btn c-btn-square c-btn-uppercase c-btn-bold">Submit</button>
                    <button type="reset" class="btn btn-lg btn-border c-btn-square c-btn-uppercase c-btn-bold">Cancel</button>
                  </div>
                </div>
              </div>
              <!-- END: ADDRESS FORM -->
            </form>
            <!-- END: PAGE CONTENT -->
          </div>
        </div>
        <!--col div-->

      </div>
    </div>
  </div>


  <!-- END: PAGE CONTENT -->
  </div>
  <!-- END: PAGE CONTAINER -->
  <!-- BEGIN: LAYOUT/FOOTERS/FOOTER-5 -->
  <?php require_once('footer.php');?>
</body>

</html>